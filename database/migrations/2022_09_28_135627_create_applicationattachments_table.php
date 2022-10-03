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
        Schema::create('application_attachments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //foreign keys (other way to do)
            $table->foreignId('application_id')->constrained();
            $table->foreignId('blob_id')->constrained();
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
