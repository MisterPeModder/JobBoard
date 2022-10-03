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
            'name' => fake()->filePath(), //random file name (include path)
            'mime_type' => fake()->mimeType(), //random mime type
            'hash' => fake()->text(255),
            'uuid' => fake()->uuid(), //fake uuid
        ];
    }
}
