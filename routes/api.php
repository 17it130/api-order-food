<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReviewController;

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

Route::group(['middleware' => 'jwt'], function () {
    Route::prefix('user')->group(function () {
        Route::get('/me', [UserController::class, 'me']);
        Route::post('/profile', [UserController::class, 'update']);
    });

    Route::prefix('notification')->group(function () {
        Route::get('/read-all', [NotificationController::class, 'readAllNotification']);
        Route::get('/', [NotificationController::class, 'getNotificationByUserId']);
        Route::get('/{id}', [NotificationController::class, 'show']);
    });

    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'getAll']);
        Route::get('/user', [OrderController::class, 'getAllByUserId']);
        Route::get('/show/{id}', [OrderController::class, 'show']);
        Route::post('/save', [OrderController::class, 'store']);
        Route::put('/update/{id}', [OrderController::class, 'update']);
        Route::delete('/remove-item/{id}', [OrderController::class, 'removeItemInOrderDetail']);
    });

    Route::prefix('review')->group(function () {
        Route::post('/save', [ReviewController::class, 'store']);
    });
});

Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'getAll']);
    Route::get('/{id}', [PaymentController::class, 'show']);
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'getAll']);
    Route::get('/{id}/food', [CategoryController::class, 'getFoodByCategoryId']);
});

Route::prefix('food')->group(function () {
    Route::get('/search', [FoodController::class, 'search']);
    Route::get('/recommend/{id}/{shop_id}', [FoodController::class, 'recommendFood']);
    Route::get('/', [FoodController::class, 'getAll']);
    Route::post('/{id}', [FoodController::class, 'show']);
});

Route::prefix('review')->group(function () {
    Route::get('/food/{food_id}', [ReviewController::class, 'getReviewByFoodId']);
    Route::get('/shop/{food_id}', [ReviewController::class, 'getReviewByShop']);
});

Route::fallback(function () {
    return response()->json(array(
        'success' => false,
        'message' => 'Page Not Found'
    ), 404);
});
