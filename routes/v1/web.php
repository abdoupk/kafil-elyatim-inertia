<?php

/** @noinspection UnknownInspectionInspection */

/** @noinspection StaticClosureCanBeUsedInspection */

use App\Http\Controllers\V1\RegisteredTenantController;
use App\Models\Orphan;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->middleware('guest')->group(function () {
        Route::get('/', function () {
            $or = Orphan::find('9c78d7d3-aee8-4463-af27-1ca69340c638');
            $or->update(['pants_size' => Str::random(2)]);
        })->name('dashboard');
    });
}
Route::get('/register', [RegisteredTenantController::class, 'create']);

Route::post(
    '/register',
    [RegisteredTenantController::class, 'store']
)->name('register')->middleware([HandlePrecognitiveRequests::class]);
