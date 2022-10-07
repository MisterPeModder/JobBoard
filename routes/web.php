<?php

use App\Http\Controllers\AssetController;
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

Route::get('/', [JobListController::class, 'index']);

Route::get('/assets/{name}', [AssetController::class, 'show']);

//user routes
Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/users/{user}/edit', [UserController::class, 'edit']);

Route::put('/users/{user}', [UserController::class, 'update']);

Route::resource('users', UserController::class);

require __DIR__.'/auth.php';
