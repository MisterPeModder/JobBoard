<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Models\Company;
use App\Models\User;
use App\Models\Blob;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('dbmakefake', function () {
    $users = User::factory(2)->create();
    echo "Users :\n" . $users . "\n";

    $blobs = Blob::factory(2)->create();
    echo "Blobs :\n" . $blobs . "\n";

    $companies = Company::factory(2)->create();
    echo "Companies :\n". $companies . "\n";

})->purpose('Make fake data in database');
