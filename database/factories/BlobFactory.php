<?php

namespace Database\Factories;

use App\Models\User;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $extension = fake()->fileExtension();

        return [
            'owner_id' => User::factory(),
            'name' => Str::of(fake()->filePath())->basename.".$extension", //random file name
            'mime_type' => MimeType::fromExtension($extension),
            'hash' => sha1(fake()->text(255)),
            'uuid' => fake()->uuid(), //fake uuid
        ];
    }
}
