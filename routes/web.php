<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobListController;
use App\Http\Controllers\UserController;
use App\Models\Advert;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', [JobListController::class, 'index'])->name('jobs');

Route::get('change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change-password');

Route::put('update-password/{user}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');

Route::resources([
    'assets' => AssetController::class,
    'jobs.apply' => JobApplicationController::class,
    'users' => UserController::class,
]);
