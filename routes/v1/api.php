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
use App\Http\Controllers\V1\API\Auth\LoginController;
use App\Http\Controllers\V1\API\Auth\LogoutController;
use App\Http\Controllers\V1\API\City\CommuneController;
use App\Http\Controllers\V1\API\City\DairaController;
use App\Http\Controllers\V1\API\City\WilayaController;
use App\Http\Controllers\V1\API\RegisterTenantController;

Route::name('api.')->group(function () {
    Route::post('/login', LoginController::class);

    Route::post('/register', RegisterTenantController::class)->name('register');

    Route::get('/wilayas', WilayaController::class)->name('list-wilayas');

    Route::post('/dairas', DairaController::class)->name('dairas');

    Route::post('/communes', CommuneController::class)->name('communes');

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', static function (Request $request) {
            return $request->user();
        });

        Route::post('/logout', LogoutController::class);

        // Add your other protected routes here
    });
});
