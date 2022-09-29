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
            $table->string('location');
            $table->string('description');
            //foreign keys
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('blob_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('blob_id')->references('id')->on('blobs');
        });
        //foreign keys for table users
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
        });
        //foreign key for table blobs
        Schema::table('blobs', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->default(0);
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
