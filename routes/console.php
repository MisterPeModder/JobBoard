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
    $number = 10; //number of records to create

    $users = User::factory($number)->create(); //creation of fake values in table users
    echo "Fake values in users table generated\n";

    $blobs = Blob::factory($number)->create();
    echo "Fake values in blobs table generated\n";

    $companies = Company::factory($number)->create();
    echo "Fake values in companies table generated\n";

    $adverts = Advert::factory($number)->create();
    echo "Fake values in adverts table generated\n";

    $applications = Application::factory($number)->create();
    echo "Fake values in applications table generated\n";

    $applicationattachments = ApplicationAttachment::factory($number)->create();
    echo "Fake values in applicationattachments table generated\n";
})->purpose('Make fake data in database');
