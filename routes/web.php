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

Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');

Route::put('update-password/{user}', [UserController::class, 'updatePassword'])->name('update-password');

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

//shows all applications of all adverts related to a company
Route::get('/companies/{company}/applications', [AdvertApplicationController::class, 'index'])
    ->name('companies.applications.index');
//shows an application of an advert
Route::get('/applications/{application}', [AdvertApplicationController::class, 'show'])->name('application.show');
//change application status
Route::put('/applications/{application}/updateAccepted', [AdvertApplicationController::class, 'updateAccepted'])->name('application.updateAccepted');
Route::put('/applications/{application}/updateDenied', [AdvertApplicationController::class, 'updateDenied'])->name('application.updateDenied');

Route::view('/admin', 'admin')
    ->can('administrate')
    ->name('admin.index');

// change localization
Route::get('/local/{locale}', function ($locale) {
    Illuminate\Support\Facades\App::setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
})->name('setlocalization');
