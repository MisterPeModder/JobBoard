<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blob>
 */
class BlobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'owner_id' => 1,
            'name' => fake()->filePath(),
            'mime_type' => 'feegg',
            'hash' => fake()->lexify('?????????????????????????????????????????????????????'),
            ];
    }
}
