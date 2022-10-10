<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table
                ->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->comment('The company this advert belongs to')
                ->constrained()
                ->cascadeOnDelete(); // delete all the adverts of a company when it gets deleted.
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['advert_id']);
            $table->dropForeign(['applicant_id']);
            $table
                ->foreign('advert_id')
                ->references('id')
                ->on('adverts')
                ->constrained()
                ->cascadeOnDelete(); // delete all the applications for an advert when it gets deleted.
            $table
                ->foreign('applicant_id')
                ->references('id')
                ->on('users')
                ->constrained()
                ->cascadeOnDelete(); // delete all the applications of an user when it gets deleted.
        });
        Schema::table('application_attachments', function (Blueprint $table) {
            $table->dropForeign(['application_id']);
            $table
                ->foreign('application_id')
                ->references('id')
                ->on('applications')
                ->constrained()
                ->cascadeOnDelete(); // delete all the attachments of an application when it gets deleted.
        });
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign(['blob_id']);
            $table
                ->foreign('blob_id')
                ->references('id')
                ->on('blobs')
                ->comment('The contents of this asset. Multple assets may point to the same blob')
                ->constrained()
                ->cascadeOnDelete(); // delete the asset when the coresponding blob gets deleted.
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table
                ->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->nullable()
                ->comment('Company owner')
                ->constrained('users')
                ->nullOnDelete(); // auto-set to NULL when the company is deleted
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table
                ->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->comment("The user's company")
                ->constrained()
                ->nullOnDelete(); // auto-set to NULL when the company is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // don't do anything to prevent NULL fields in non-NULL columns
    }
};
