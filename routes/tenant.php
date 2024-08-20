<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\V1\CitySearchController;
use App\Http\Controllers\V1\Trash\TrashIndexController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login')
        ->middleware('guest');

    Route::name('tenant.')->prefix('/dashboard/')->group(function () {
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

        Route::middleware('auth')->group(function () {
            require_once __DIR__.'/v1/academic-achievements.php';

            require_once __DIR__.'/v1/archive.php';

            require_once __DIR__.'/v1/branches.php';

            require_once __DIR__.'/v1/college-achievements.php';

            require_once __DIR__.'/v1/dashboard.php';

            require_once __DIR__.'/v1/families.php';

            require_once __DIR__.'/v1/financial.php';

            require_once __DIR__.'/v1/inventory.php';

            require_once __DIR__.'/v1/lessons.php';

            require_once __DIR__.'/v1/list.php';

            require_once __DIR__.'/v1/members.php';

            require_once __DIR__.'/v1/needs.php';

            require_once __DIR__.'/v1/notifications.php';

            require_once __DIR__.'/v1/occasions.php';

            require_once __DIR__.'/v1/orphans.php';

            require_once __DIR__.'/v1/profile.php';

            require_once __DIR__.'/v1/roles.php';

            require_once __DIR__.'/v1/schools.php';

            require_once __DIR__.'/v1/settings.php';

            require_once __DIR__.'/v1/sponsors.php';

            require_once __DIR__.'/v1/vocational-training-achievements.php';

            require_once __DIR__.'/v1/zones.php';

            Route::get('trash', TrashIndexController::class)->name('trash');

            Route::get('search/cities', CitySearchController::class)->name('cities.search');

            Route::post(
                'logout',
                [AuthenticatedSessionController::class, 'destroy']
            )->name('logout');
        });
    });
});
