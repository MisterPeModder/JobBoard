<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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
