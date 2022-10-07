<?php

use App\Enums\Currency;
use App\Enums\JobType;
use App\Enums\SalaryType;
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
            $table->renameColumn('description', 'full_description');
        });
        Schema::table('adverts', function (Blueprint $table) {
            $table
                ->string('title', 255)
                ->comment('The user-facing title of the advert')
                ->change();
            $table
                ->text('full_description')
                ->comment('Full description of the advert')
                ->change();
            $table
                ->text('short_description')
                ->comment('Bullet points about the advert');
            $table
                ->string('location')
                ->nullable()
                ->comment('The place of work, or "remote"');
            $table
                ->enum('job_type', JobType::stringCases())
                ->nullable()
                ->comment('The contract type');
            $table
                ->decimal('salary_min', 19, 4)
                ->nullable()
                ->comment('Salary lower-bound in the given currency');
            $table
                ->decimal('salary_max', 19, 4)
                ->nullable()
                ->comment('Salary upper-bound in the given currency');
            $table
                ->enum('salary_type', SalaryType::stringCases())
                ->nullable()
                ->comment('The type of salary');
            $table
                ->enum('salary_currency', Currency::stringCases())
                ->nullable()
                ->comment('The type ofsalary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adverts', function (Blueprint $table) {
            $table->renameColumn('full_description', 'description');
        });
        Schema::table('adverts', function (Blueprint $table) {
            $table
                ->string('description', 255)
                ->default('')
                ->change();
            $table->dropColumn(['short_description', 'location', 'job_type', 'salary_min', 'salary_max', 'salary_type', 'salary_currency']);
        });
    }
};
