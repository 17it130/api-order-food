<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
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
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/food', [FoodController::class, 'index'])->name('food.index');
    // Route::get('/food/{id}', [FoodController::class, 'edit'])->name('food.edit');
    // Route::post('/food/{id}', [FoodController::class, 'update'])->name('food.update');
    Route::resource('/category', CategoryController::class);
    Route::resource('/food', FoodController::class);
});
