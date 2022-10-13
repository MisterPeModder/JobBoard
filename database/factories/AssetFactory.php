<?php

namespace Database\Factories;

use App\Models\Blob;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => Str::of(fake()->filePath())->basename().'.'.fake()->fileExtension(), //random file name
            'mime_type' => fn (array $attributes) => MimeType::fromFilename($attributes['name']),
        ];
    }

    /**
     * Allows anyone to view this asset.
     */
    public function public(): Factory
    {
        return $this->state(function () {
            return ['access' => 'public'];
        });
    }

    /**
     * Creates an asset (and a correspoding blob) from one of the images in the `storage/app/examples` directory.
     */
    public function randomImage(): Factory
    {
        return $this->state(function () {
            $disk = Storage::disk('local');

            $srcPath = Arr::random($disk->files('examples'));
            $contents = $disk->readStream($srcPath);

            $blob = Blob::factory()->storeFrom($contents)->create();

            $basename = Str::of($srcPath)->basename();

            return [
                'name' => $basename,
                'blob_id' => $blob->id,
                'mime_type' => MimeType::fromFilename($basename),
            ];
        });
    }

    /**
     * Creates an asset (and a correspoding blob) from the given file upload.
     */
    public function storeFile(UploadedFile $file, ?string $name = null): Factory
    {
        return $this->state(function () use ($file, $name) {
            $blob = Blob::factory()->storeFile($file)->create();

            if ($name === null) {
                $name = $file->hashName();
            }

            return [
                'name' => $name.'.'.$file->extension(),
                'blob_id' => $blob->id,
                'mime_type' => $file->getMimeType(),
            ];
        });
    }
}
