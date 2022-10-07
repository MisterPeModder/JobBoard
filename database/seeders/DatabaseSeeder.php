<?php

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\Asset;
use App\Models\Blob;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Slience constraints errors for the time being
        Schema::disableForeignKeyConstraints();

        // Generate 15 blobs with junk data.
        Asset::factory(15, ['blob_id' => Blob::factory()->storeRandom()])->create();

        // Generate 10 users with 1 icon each
        Asset::factory()
            ->count(10)
            ->randomImage()
            ->create()
            ->each(function (Asset $asset) {
                $user = User::factory()->state(['icon_id' => $asset->id])->create();
                $asset->user()->associate($user);
                $asset->save();
            });

        // Choose 3 random CEOs among our users
        $bosses = User::all()->random(3);

        // Generate 3 companies with our bosses as their owner
        Asset::factory()
            ->count(3)
            ->randomImage()
            ->create()
            ->each(function (Asset $asset, $i) use ($bosses) {
                $boss = $bosses->get($i);
                $company = Company::factory()
                    ->state([
                        'icon_id' => $asset->id,
                        'owner_id' => $boss->id,
                    ])
                    ->create();
                $asset->company()->associate($company);
                $boss->company()->associate($company);
                $asset->save();
                $boss->save();
            });

        // Generate 21 job listings
        Advert::factory()
            ->count(21)
            ->random()
            ->state([
                'company_id' => fn () => Company::inRandomOrder()->first()->id,
            ])
            ->create();

        // Re-enable constraints validation
        Schema::enableForeignKeyConstraints();
    }
}
