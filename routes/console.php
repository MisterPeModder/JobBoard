<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Models\Advert;
use App\Models\Application;
use App\Models\ApplicationAttachment;
use App\Models\Blob;
use App\Models\Company;
use App\Models\User;
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


/**
 * Create some fake values in database
 */
Artisan::command('dbmakefake', function () {
    $number = 1;//number of records to create

    $users = User::factory($number)->create();//creation of fake values in table users
    echo "Users :\n" . $users . "\n";

    $blobs = Blob::factory($number)->create();
    echo "Blobs :\n" . $blobs . "\n";

    $companies = Company::factory($number)->create();
    echo "Companies :\n". $companies . "\n";

    $adverts = Advert::factory($number)->create();
    echo "Advertisements :\n". $adverts . "\n";

    $applications = Application::factory($number)->create();
    echo "Applications :\n". $applications . "\n";

    $applicationattachements = ApplicationAttachment::factory($number)->create();
    echo "Application's attachements :\n". $applicationattachements . "\n";

})->purpose('Make fake data in database');
