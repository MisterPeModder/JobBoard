<?php

use App\Http\Controllers\AdvertApplicationController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
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

Route::view('/', 'main-page');

Route::get('change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change-password');

Route::put('update-password/{user}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');

Route::resources([
    'assets' => AssetController::class,
    'companies' => CompanyController::class,
    'jobs.apply' => AdvertApplicationController::class,
    'users' => UserController::class,
]);

Route::resource('jobs', AdvertController::class)
    ->except(['create', 'store'])
    ->parameter('jobs', 'advert');

Route::post('/companies/{company}/edit/member', [CompanyController::class, 'addMember'])
    ->can('update-members', 'company')
    ->name('companies.edit.member.add');
Route::delete('/companies/{company}/edit/member/{member}', [CompanyController::class, 'removeMember'])
    ->can('update-members', 'company')
    ->name('companies.edit.member.remove');
Route::get('/companies/{company}/edit/set-owner/{owner}', [CompanyController::class, 'setOwner'])
    ->can('change-owner', 'company')
    ->name('companies.edit.set-owner');

// shows adverts of a company, with a filter to the main jobs page
Route::get('/companies/{company}/jobs', function ($company) {
    return redirect()->route('jobs.index', ['company' => $company]);
})->name('companies.jobs.index');
Route::get('/companies/{company}/jobs/create', [AdvertController::class, 'create'])
    ->can('create-advert', 'company')
    ->name('companies.jobs.create');
Route::post('/companies/{company}/job', [AdvertController::class, 'store'])
    ->can('create-advert', 'company')
    ->name('companies.jobs.store');

// TODO (#24): implement admin page
Route::permanentRedirect('/admin', '/')->name('admin.index');
