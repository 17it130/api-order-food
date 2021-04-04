<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FoodController;

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

Route::prefix('admin')->group(function() {
    Route::get('/dang-nhap', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Route::get('/food', [FoodController::class, 'index'])->name('food.index');
    Route::resource('/food', FoodController::class);
});