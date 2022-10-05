<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Create the `assets` table, and move all the foreign keys from `blobs` to it.
     *
     * @return void
     */
    public function up()
    {
        // Create the assets table
        Schema::create('assets', function (Blueprint $table) {
            $table->id(); // Primary key, auto increments
            $table->timestamps(); // 'created_at' and 'updated_at' timestamps
            $table
                ->string('name')
                ->comment('A human-readable name for this asset, not unique');
            $table
                ->string('mime_type')
                ->comment('MIME type (e.g. image/jpeg)');
            $table
                ->enum('access', ['private', 'public'])
                ->default('private')
                ->comment('Access control. "private" means only the owner user and company may access it');

            /* FOREIGN KEYS */
            $table
                ->foreignId('user_id') // references App\Models\User
                ->nullable()
                ->comment('The owner of this asset. Nullable (NULL is the default)')
                ->constrained()
                ->nullOnDelete(); // auto-set to NULL when the user is deleted
            $table
                ->foreignId('company_id') // references App\Models\Company
                ->nullable()
                ->comment('The company this asset has been granted access to. Nullable (NULL is the default)')
                ->constrained()
                ->nullOnDelete(); // auto-set to NULL when the company is deleted
            $table
                ->foreignId('blob_id') // references App\Models\Blob
                ->comment('The contents of this asset. Multple assets may point to the same blob')
                ->constrained()
                ->restrictOnDelete(); // prevents the blob from being deleted if assets still points to it
        });

        // Update users.icon_id foreign key to point to assets
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_icon_id_foreign');
            $table->dropColumn('icon_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table
                ->foreignId('icon_id')
                ->nullable()
                ->comment('User profile icon')
                ->constrained('assets')
                ->nullOnDelete(); // auto-set to NULL when the icon asset is deleted
        });

        // Update company.icon_id foreign key to point to assets
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('companies_icon_id_foreign');
            $table->dropColumn('icon_id');
        });
        Schema::table('companies', function (Blueprint $table) {
            $table
                ->foreignId('icon_id')
                ->nullable()
                ->comment('Company profile icon')
                ->constrained('assets')
                ->nullOnDelete(); // auto-set to NULL when the icon asset is deleted
        });

        // Update application_attachments.blob_id foreign key to point to assets
        Schema::table('application_attachments', function (Blueprint $table) {
            $table->dropForeign(['blob_id']);
            $table->dropColumn('blob_id');
            $table
                ->foreignId('asset_id')
                ->comment('Attached file')
                ->constrained()
                ->cascadeOnDelete();
        });

        // Remove the corresponding attributes from the 'blobs' table
        Schema::table('blobs', function (Blueprint $table) {
            $table->dropForeign('blobs_owner_id_foreign');
            $table->dropForeign('blobs_company_id_foreign');
            $table->dropColumn(['name', 'mime_type', 'access', 'owner_id', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reverse update users.icon_id foreign key to poin back to blobs
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('icon_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table
                ->foreignId('icon_id')
                ->nullable()
                ->constrained('blobs');
        });

        // Reverse update companies.icon_id foreign key to poin back to blobs
        Schema::table('companies', function (Blueprint $table) {
            $table->dropConstrainedForeignId('icon_id');
        });
        Schema::table('companies', function (Blueprint $table) {
            $table
                ->foreignId('icon_id')
                ->nullable()
                ->constrained('blobs');
        });

        // Update application_attachments.blob_id foreign key to point to assets
        Schema::table('application_attachments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('asset_id');
            $table->foreignId('blob_id')->constrained();
        });

        Schema::table('blobs', function (Blueprint $table) {
            $table->string('name');
            $table->string('mime_type');
            $table->string('access')->default('PRIVATE');
            $table->foreignId('owner_id')->nullable()->constrained('users');
            $table->foreignId('company_id')->nullable()->constrained();
        });

        Schema::dropIfExists('assets');
    }
};
