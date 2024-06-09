<?php

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

// Public routes
use App\Http\Controllers\V1\API\AuthController;
use App\Http\Controllers\V1\API\CityController;
use App\Http\Controllers\V1\API\RegisterTenantController;

Route::name('api.')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/register', RegisterTenantController::class)->name('register');

    Route::get('/wilayas', [CityController::class, 'wilayas']);

    Route::post('/dairas', [CityController::class, 'dairas']);

    Route::post('/communes', [CityController::class, 'communes']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', static function (Request $request) {
            return $request->user();
        });

        Route::post('/logout', [AuthController::class, 'logout']);

        // Add your other protected routes here
    });
});
