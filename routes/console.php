<?php

use App\Models\Advert;
use App\Models\Application;
use App\Models\ApplicationAttachment;
use App\Models\Asset;
use App\Models\Blob;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

Artisan::command('dbmakefake', function () {
    echo "Please use db:seed to fill database instead\n";
});

// alias to the php-cs-fixer command
Artisan::command('cs-fixer {args?*}', function ($args) {
    $argsStr = stream_isatty(STDOUT) ? '--ansi' : '--no-ansi';
    if (empty($args)) {
        $argsStr .= ' fix';
    }
    foreach ($args as $arg) {
        $argsStr .= ' '.escapeshellarg($arg);
    }
    passthru("./vendor/bin/php-cs-fixer $argsStr");
})->purpose('Runs the PHP Coding Standards Fixer');

Artisan::command('blob:wipe', function () {
    $disk = Storage::disk('blobs');

    foreach ($disk->files() as $file) {
        if (Str::isUuid($file)) {
            $disk->delete($file);
        }
    }
})->purpose('Delete all blobs in the storage/app/blobs directory');

Artisan::command('db:clear {--y|yes : Do not ask for confirmation}', function ($yes) {
    if (! $yes && ! $this->confirm('Are you sure? This will truncate all tables!')) {
        return;
    }
    Schema::disableForeignKeyConstraints();

    Advert::truncate();
    Application::truncate();
    ApplicationAttachment::truncate();
    Asset::truncate();
    Blob::truncate();
    Company::truncate();
    User::truncate();
    Artisan::call('blob:wipe');

    Schema::enableForeignKeyConstraints();

    $this->info('Database truncated successfully!');
})->purpose('Deletes all rows in the database without dropping tables');
