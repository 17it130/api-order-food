<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('auth')->group(function () {
    Route::post('/google', [AuthController::class, 'loginWithGoogle']);
});

Route::group([ 'middleware' => 'jwt'], function () {
    Route::prefix('user')->group(function() {
        Route::get('/me', [UserController::class, 'me']);
        Route::post('/profile', [UserController::class, 'update']);
    });

    Route::prefix('order')->group(function() {
       Route::get('/', [OrderController::class, 'getAll']);
       Route::get('/show/{id}', [OrderController::class, 'show']);
       Route::post('/save', [OrderController::class, 'store']);
       Route::put('/update/{id}', [OrderController::class, 'update']);
       Route::delete('/remove-item/{id}', [OrderController::class, 'removeItemInOrderDetail']);
    });
});


Route::prefix('food')->group(function () {
    Route::get('/', [FoodController::class, 'getAll']);
    Route::get('/{id}', [FoodController::class, 'show']);
});
