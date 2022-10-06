<?php

namespace Database\Factories;

use App\Enums\Currency;
use App\Enums\JobType;
use App\Enums\SalaryType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advert>
 */
class AdvertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [];
    }

    /**
     * Makes random adverts.
     */
    public function random(): Factory
    {
        return $this->state(function () {
            $hourlySalaryMin = mt_rand(10, 40);
            // 1/2 chance to be same as min
            $hourlySalaryMax = $hourlySalaryMin + (mt_rand(1, 2) == 1 ? 0 : mt_rand(1, 5));
            $salaryType = Arr::random(SalaryType::cases());

            $salaryMultiplier = match ($salaryType) {
                SalaryType::Once => 200,
                SalaryType::Hourly => 1,
                SalaryType::Daily => 8,
                SalaryType::Weekly => 8 * 5,
                SalaryType::Monthly => 8 * 5 * 30,
                SalaryType::Yearly => 8 * 5 * 30 * 360,
            };

            $shortDesc = [];
            for ($i = 0, $len = mt_rand(1, 5); $i < $len; ++$i) {
                array_push($shortDesc, fake()->sentence(6, true));
            }

            return [
                'title' => fake()->sentence(4), //random title
                'full_description' => fake()->realText(), //random text
                'short_description' => Arr::join($shortDesc, '\n'),
                'location' => mt_rand(1, 5) == 1 ? 'remote' : fake()->city(), // 1/5 chance to be 'remote'
                'job_type' => Arr::random(JobType::stringCases()),
                'salary_min' => $hourlySalaryMin * $salaryMultiplier,
                'salary_max' => $hourlySalaryMax * $salaryMultiplier,
                'salary_type' => $salaryType->value,
                'salary_currency' => Arr::random(Currency::stringCases()),
            ];
        });
    }
}
