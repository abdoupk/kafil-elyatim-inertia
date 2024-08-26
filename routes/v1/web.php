<?php

declare(strict_types=1);

use App\Http\Controllers\V1\RegisteredTenantController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->middleware('guest')->group(function () {
        Route::get('/', function () {
            return view('landing');
        })->name('dashboard');
    });
}

Route::get('/register', [RegisteredTenantController::class, 'create']);

Route::post(
    '/register',
    [RegisteredTenantController::class, 'store']
)->name('register')->middleware([HandlePrecognitiveRequests::class]);
