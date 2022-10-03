<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blobs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('mime_type');
            $table->tinyText('hash');
            $table->uuid('uuid');
            $table->string('access')->default('PRIVATE');
            //foreign keys
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
        });
        //foreign key for table users
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('icon_id')->nullable();
            $table->foreign('icon_id')->references('id')->on('blobs');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blobs');
    }
};
