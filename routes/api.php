<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodController;

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

Route::prefix('food')->group(function () {
    Route::get('/', [FoodController::class, 'getAll']);
    Route::get('/{id}', [FoodController::class, 'show']);
});
