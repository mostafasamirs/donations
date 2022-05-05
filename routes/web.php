<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KioskController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\ChairtyController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\DonatorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DonationController;

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

Route::get('/', function () {
    return view('welcome')->name('welcome');
});

Auth::routes();
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/lang/{lang}', [HomeController::class, 'lang'])->name('admin.lang');

    Route::resource('users', UserController::class);
    Route::resource('kiosks', KioskController::class);
    // Route::resource('charities', ChairtyController::class);

    //
    Route::resource('donators', DonatorController::class);
    Route::get('ajax/search-by-mobile', [DonatorController::class, 'SearchByMobile'])->name('search-by-mobile-ajax');
    Route::resource('deposits', DepositController::class);
    Route::post('ajax/deposits-store-ajax', [DepositController::class, 'storeAjax']);
    Route::resource('donations', DonationController::class);
    Route::post('ajax/donations-store-ajax', [DonationController::class, 'storeAjax'])->name('donations-store-ajax');//receipt
    Route::get('receipt/{id}', [DonationController::class, 'receipt'])->name('receipt');
    Route::resource('shifts', ShiftController::class);
    Route::post('endshift/{id}', [ShiftController::class, 'endshift'])->name('admin.endshift');
    //
    Route::resource('roles', RoleController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('/clear-cache', function () {
      // Artisan::call('route:cache');
      Artisan::call('route:clear');
      Artisan::call('view:clear');
      Artisan::call('view:cache');
      Artisan::call('cache:clear');
      Artisan::call('config:cache');
      Artisan::call('config:clear');
      Artisan::call('storage:link');
      return redirect()->back()->with('toast_success', __('clear cache Successfully'));
    })->name('clear_cache');
    Route::fallback(function () {
      // $title = __('notfound');
      return view('admin.layouts.404');
    });

});

