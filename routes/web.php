<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

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

Route::group(['middleware' => 'web'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
    Route::get('/google', [AuthController::class, 'redirectToGoogle'])->name('auth.gRedirect');
    Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback']);

    Route::group(['prefix' => 'admin', 'middleware' => ['isAuth', 'revalidate']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/category', CategoryController::class);
        Route::resource('/food', FoodController::class);
        Route::resource('/category', CategoryController::class);
        Route::resource('/food', FoodController::class);
        Route::resource('/order', OrderController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/payment', PaymentController::class);
        Route::resource('/slider', SliderController::class);

        // For hosting
        Route::get('/migrate', function () {
            Artisan::call('migrate');
        });
        Route::get('/seeder', function () {
            Artisan::call('db:seed');
        });

        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    });
});
