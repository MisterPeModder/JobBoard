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
        Schema::create('applicationattachements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //foreign keys (other way to do)
            $table->foreignId('application_id')->constrained();
            $table->foreignId('blob_id')->constrained();
        });
        //foreign key for table applications
        Schema::table('applications', function (Blueprint $table) {
            $table->unsignedBigInteger('applicant_id');
            $table->foreign('applicant_id')->references('id')->on('applicationattachements');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicationattachements');
    }
};
