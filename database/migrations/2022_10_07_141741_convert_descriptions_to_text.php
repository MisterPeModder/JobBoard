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
        Schema::table('applications', function (Blueprint $table) {
            $table->text('content')
                ->comment('The application message')
                ->change();
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->text('description')
                ->comment('A possibly lengthy description of the company')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('content', 255)
                ->change();
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->string('description', 255)
                ->change();
        });
    }
};
