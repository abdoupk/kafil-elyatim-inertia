<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\V1\Dashboard\DashboardController;
use App\Http\Controllers\V1\Families\DownloadFamiliesController;
use App\Http\Controllers\V1\Families\FamiliesIndexController;
use App\Http\Controllers\V1\Families\FamilyCreateController;
use App\Http\Controllers\V1\Families\FamilyDeleteController;
use App\Http\Controllers\V1\Families\FamilyEditController;
use App\Http\Controllers\V1\Families\FamilyShowController;
use App\Http\Controllers\V1\Members\MembersIndexController;
use App\Http\Controllers\V1\Orphans\OrphansIndexController;
use App\Http\Controllers\V1\Permissions\PermissionsIndexController;
use App\Http\Controllers\V1\Roles\RolesIndexController;
use App\Http\Controllers\V1\Sponsors\SponsorsIndexController;
use Illuminate\Support\Facades\Route;
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
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login')
        ->middleware('guest');

    Route::name('tenant.')->prefix('/dashboard/')->group(function () {
        Route::middleware('auth')->group(function () {
            // Logout route
            Route::post(
                'logout',
                [AuthenticatedSessionController::class, 'destroy']
            )->name('logout');

            Route::get('', DashboardController::class)
                ->name('dashboard');

            Route::prefix('families')->name('families.')->group(function () {
                Route::get('', FamiliesIndexController::class)
                    ->name('index');

                Route::get('/create', FamilyCreateController::class)
                    ->name('create');

                Route::get('edit/{family}', FamilyEditController::class)
                    ->name('edit');

                Route::get('show/{family}', FamilyShowController::class)
                    ->name('show');

                Route::delete('{family}', FamilyDeleteController::class)
                    ->name('destroy');

                Route::get('download', DownloadFamiliesController::class);
            });

            Route::get('orphans', OrphansIndexController::class)
                ->name('orphans.index');

            Route::get('members', MembersIndexController::class)
                ->name('members.index');

            Route::get('roles', RolesIndexController::class)
                ->name('roles.index');

            Route::get('permissions', PermissionsIndexController::class)
                ->name('permissions.index');

            Route::get('sponsors', SponsorsIndexController::class)
                ->name('sponsors.index');
        });

        Route::middleware('guest')->group(function () {
            Route::post(
                'login',
                [AuthenticatedSessionController::class, 'store']
            );
        });

        Route::middleware('guest')->group(function () {
            Route::post(
                'login',
                [AuthenticatedSessionController::class, 'store']
            )->name('login');
        });
    });
});
