<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\V1\Auth\ConfirmablePasswordController;
use App\Http\Controllers\V1\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\V1\Auth\EmailVerificationPromptController;
use App\Http\Controllers\V1\Auth\NewPasswordController;
use App\Http\Controllers\V1\Auth\PasswordController;
use App\Http\Controllers\V1\Auth\PasswordResetLinkController;
use App\Http\Controllers\V1\Auth\VerifyEmailController;
use App\Http\Controllers\V1\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here we define the routes for the tenant application. These routes are
| protected by the 'web', 'InitializeTenancyByDomain', and
| 'PreventAccessFromCentralDomains' middleware.
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Guest Routes
    |--------------------------------------------------------------------------
    |
    | These routes are accessible only for guests (unauthenticated users).
    |
    */
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login')
        ->middleware('guest');

    /*
    |--------------------------------------------------------------------------
    | Tenant Routes
    |--------------------------------------------------------------------------
    |
    | These routes are prefixed with 'tenant.' and require authentication.
    |
    */
    Route::name('tenant.')->group(function () {
        Route::middleware('auth')->group(function () {
            // Test page route
            Route::get('welcome/create/new', static function () {
                return Inertia::render('TestPage');
            })->name('test');

            // Dashboard route (requires email verification)
            Route::get('/', static function () {
                return Inertia::render('TheDashboardPage');
            })->middleware('verified')->name('dashboard');

            // Profile management routes
            Route::prefix('profile')->group(function () {
                Route::get(
                    '/',
                    [ProfileController::class, 'edit']
                )->name('profile.edit');
                Route::patch(
                    '/',
                    [ProfileController::class, 'update']
                )->name('profile.update');
                Route::delete(
                    '/',
                    [ProfileController::class, 'destroy']
                )->name('profile.destroy');
            });

            // Email verification routes
            Route::get(
                'verify-email',
                EmailVerificationPromptController::class
            )->name('verification.notice');
            Route::get(
                'verify-email/{id}/{hash}',
                VerifyEmailController::class
            )->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
            Route::post(
                'email/verification-notification',
                [EmailVerificationNotificationController::class, 'store']
            )->middleware('throttle:6,1')
                ->name('verification.send');

            // Password management routes
            Route::get(
                'confirm-password',
                [ConfirmablePasswordController::class, 'show']
            )->name('password.confirm');
            Route::post(
                'confirm-password',
                [ConfirmablePasswordController::class, 'store']
            );
            Route::put(
                'password',
                [PasswordController::class, 'update']
            )->name('password.update');

            // Logout route
            Route::post(
                'logout',
                [AuthenticatedSessionController::class, 'destroy']
            )->name('logout');
        });

        /*
        |--------------------------------------------------------------------------
        | Guest Routes
        |--------------------------------------------------------------------------
        |
        | These routes are accessible only for guests (unauthenticated users).
        |
        */
        Route::middleware('guest')->group(function () {
            Route::post(
                'login',
                [AuthenticatedSessionController::class, 'store']
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Guest Routes
        |--------------------------------------------------------------------------
        |
        | These routes are accessible only for guests (unauthenticated users).
        |
        */
        Route::middleware('guest')->group(function () {
            Route::post(
                'login',
                [AuthenticatedSessionController::class, 'store']
            )->name('login');

            // Password reset routes
            Route::get(
                'forgot-password',
                [PasswordResetLinkController::class, 'create']
            )->name('password.request');
            Route::post(
                'forgot-password',
                [PasswordResetLinkController::class, 'store']
            )->name('password.email');
            Route::get(
                'reset-password/{token}',
                [NewPasswordController::class, 'create']
            )->name('password.reset');
            Route::post(
                'reset-password',
                [NewPasswordController::class, 'store']
            )->name('password.store');
        });
    });
});
