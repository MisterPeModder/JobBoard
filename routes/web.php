<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CompanyController;
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

Route::get('/', [JobListController::class, 'index'])->name('jobs.index');

Route::get('change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change-password');

Route::put('update-password/{user}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');

Route::resources([
    'assets' => AssetController::class,
    'companies' => CompanyController::class,
    'jobs.apply' => JobApplicationController::class,
    'users' => UserController::class,
]);

Route::post('/companies/{company}/edit/member', [CompanyController::class, 'addMember'])
    ->can('update-members', 'company')
    ->name('companies.edit.member.add');
Route::delete('/companies/{company}/edit/member/{member}', [CompanyController::class, 'removeMember'])
    ->can('update-members', 'company')
    ->name('companies.edit.member.remove');
Route::get('/companies/{company}/edit/set-owner/{owner}', [CompanyController::class, 'setOwner'])
    ->can('change-owner', 'company')
    ->name('companies.edit.set-owner');
