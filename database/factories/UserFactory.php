<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => fake()->unique()->safeEmail(), //random valid email
            'email_verified_at' => now(),
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'password' => Hash::make('default'), //default password is 'default'
            'is_admin' => false,
        ];
    }
}
