<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
            'uuid' => fake()->uuid(), //fake uuid
            'hash' => function ($attributes) {
                return sha1_file(storage_path('app/blobs/'.$attributes['uuid']));
            },
        ];
    }

    /**
     * Stores this blob in the `strorage/app/blobs` directory using random contents.
     */
    public function storeRandom(): Factory
    {
        return $this->state(function (array $attributes) {
            $dstPath = storage_path('app/blobs/'.$attributes['uuid']);
            file_put_contents($dstPath, fake()->text());

            return [];
        });
    }

    /**
     * Stores this blob in the `strorage/app/blobs` directory using the given contents.
     *
     * @param string|resource $contents The content to store on disk.
     */
    public function storeFrom($contents): Factory
    {
        return $this->state(function (array $attributes) use ($contents) {
            Storage::disk('blobs')->put($attributes['uuid'], $contents);

            return [];
        });
    }
}
