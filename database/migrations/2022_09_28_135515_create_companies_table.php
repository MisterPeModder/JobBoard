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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('description')->nullable();
            //foreign keys
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('icon_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('icon_id')->references('id')->on('blobs');
        });
        
        //foreign keys for table users
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->default(null);
            $table->foreign('company_id')->references('id')->on('companies');
        });
        //foreign key for table blobs
        Schema::table('blobs', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->default(null);
            $table->foreign('company_id')->references('id')->on('companies');
        });
        //foreign key for table adverts
        Schema::table('adverts', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
