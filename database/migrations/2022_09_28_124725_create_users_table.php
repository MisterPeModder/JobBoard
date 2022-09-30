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
        /**
         * Function needed to create table
         */
        Schema::create('users', function (Blueprint $table) {
            $table->id();//primary key
            $table->timestamps();//date + houre of creation + last edit
            $table->string('email')->unique();//string : stores characters, equivalent of VARCHAR(255) in mysql
                                              //unique : email must be unique
            $table->string('name')->nullable();//nullable : value can be null
            $table->string('surname')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
