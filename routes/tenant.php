<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\V1\Branches\BranchDeleteController;
use App\Http\Controllers\V1\Branches\BranchesIndexController;
use App\Http\Controllers\V1\Branches\BranchShowController;
use App\Http\Controllers\V1\Branches\BranchStoreController;
use App\Http\Controllers\V1\Branches\BranchUpdateController;
use App\Http\Controllers\V1\Dashboard\DashboardController;
use App\Http\Controllers\V1\Families\ExportFamiliesPDFController;
use App\Http\Controllers\V1\Families\ExportFamiliesXlsxController;
use App\Http\Controllers\V1\Families\FamiliesIndexController;
use App\Http\Controllers\V1\Families\FamilyCreateController;
use App\Http\Controllers\V1\Families\FamilyDeleteController;
use App\Http\Controllers\V1\Families\FamilyEditController;
use App\Http\Controllers\V1\Families\FamilyShowController;
use App\Http\Controllers\V1\Families\FamilyStoreController;
use App\Http\Controllers\V1\Financial\FinancialIndexController;
use App\Http\Controllers\V1\Inventory\InventoryIndexController;
use App\Http\Controllers\V1\Inventory\ItemDeleteController;
use App\Http\Controllers\V1\Inventory\ItemShowController;
use App\Http\Controllers\V1\Inventory\ItemStoreController;
use App\Http\Controllers\V1\Inventory\ItemUpdateController;
use App\Http\Controllers\V1\Members\MemberCreateController;
use App\Http\Controllers\V1\Members\MemberDeleteController;
use App\Http\Controllers\V1\Members\MemberShowController;
use App\Http\Controllers\V1\Members\MembersIndexController;
use App\Http\Controllers\V1\Members\MemberStoreController;
use App\Http\Controllers\V1\Members\MemberUpdateController;
use App\Http\Controllers\V1\Occasions\EidAlAdha\EidAlAdhaIndexController;
use App\Http\Controllers\V1\Occasions\EidAlAdha\ExportFamiliesEidAlAdhaPDF;
use App\Http\Controllers\V1\Occasions\EidAlAdha\ExportFamiliesEidAlAdhaXlsxController;
use App\Http\Controllers\V1\Orphans\ExportOrphansPDFController;
use App\Http\Controllers\V1\Orphans\ExportOrphansXlsxController;
use App\Http\Controllers\V1\Orphans\OrphanDeleteController;
use App\Http\Controllers\V1\Orphans\OrphanShowController;
use App\Http\Controllers\V1\Orphans\OrphansIndexController;
use App\Http\Controllers\V1\Roles\RolesIndexController;
use App\Http\Controllers\V1\Settings\SettingsIndexController;
use App\Http\Controllers\V1\Settings\UpdateSettingsController;
use App\Http\Controllers\V1\Sponsors\ExportSponsorsPDFController;
use App\Http\Controllers\V1\Sponsors\ExportSponsorsXlsxController;
use App\Http\Controllers\V1\Sponsors\SponsorDeleteController;
use App\Http\Controllers\V1\Sponsors\SponsorShowController;
use App\Http\Controllers\V1\Sponsors\SponsorsIndexController;
use App\Http\Controllers\V1\Statistics\StatisticsIndexController;
use App\Http\Controllers\V1\Zones\ZoneDeleteController;
use App\Http\Controllers\V1\Zones\ZoneShowController;
use App\Http\Controllers\V1\Zones\ZonesIndexController;
use App\Http\Controllers\V1\Zones\ZoneStoreController;
use App\Http\Controllers\V1\Zones\ZoneUpdateController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
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

                Route::post('/store', FamilyStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::get('edit/{family}', FamilyEditController::class)
                    ->name('edit');

                Route::get('show/{family}', FamilyShowController::class)
                    ->name('show');

                Route::delete('{family}', FamilyDeleteController::class)
                    ->name('destroy');

                Route::get('export-pdf', ExportFamiliesPDFController::class)
                    ->name('export.pdf');

                Route::get('export-xlsx', ExportFamiliesXlsxController::class)
                    ->name('export.xlsx');
            });

            Route::prefix('inventory')->group(function () {
                Route::get('', InventoryIndexController::class)
                    ->name('inventory.index');

                Route::post('/store', ItemStoreController::class)
                    ->name('items.store')->middleware([HandlePrecognitiveRequests::class]);

                Route::get('show/{item}', ItemShowController::class)
                    ->name('items.show');

                Route::put('{item}', ItemUpdateController::class)
                    ->name('items.update')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{item}', ItemDeleteController::class)
                    ->name('items.destroy');
            });

            Route::prefix('branches')->name('branches.')->group(function () {
                Route::get('', BranchesIndexController::class)
                    ->name('index');

                Route::get('show/{branch}', BranchShowController::class)
                    ->name('show');

                Route::put('{branch}', BranchUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', BranchStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{branch}', BranchDeleteController::class)
                    ->name('destroy');
            });

            Route::prefix('orphans')->name('orphans.')->group(function () {
                Route::get('', OrphansIndexController::class)
                    ->name('index');

                Route::get('show/{orphan}', OrphanShowController::class)
                    ->name('show');

                Route::delete('{orphan}', OrphanDeleteController::class)
                    ->name('destroy');

                Route::get('export-pdf', ExportOrphansPDFController::class)
                    ->name('export.pdf');

                Route::get('export-xlsx', ExportOrphansXlsxController::class)
                    ->name('export.xlsx');
            });

            Route::prefix('members')->name('members.')->group(function () {
                Route::get('', MembersIndexController::class)
                    ->name('index');

                Route::get('show/{member}', MemberShowController::class)
                    ->name('show');

                Route::get('create', MemberCreateController::class)
                    ->name('create');

                Route::put('{member}', MemberUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', MemberStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{member}', MemberDeleteController::class)
                    ->name('destroy');
            });

            Route::prefix('roles')->name('roles.')->group(function () {
                Route::get('', RolesIndexController::class)
                    ->name('index');
            });

            Route::prefix('sponsors')->name('sponsors.')->group(function () {
                Route::get('', SponsorsIndexController::class)
                    ->name('index');

                // TODO fix 404 issue
                Route::get('show/{sponsor}', SponsorShowController::class)
                    ->name('show');

                // TODO fix 404 issue
                Route::delete('{sponsor}', SponsorDeleteController::class)
                    ->name('destroy');

                Route::get('export-pdf', ExportSponsorsPDFController::class)
                    ->name('export.pdf');

                Route::get('export-xlsx', ExportSponsorsXlsxController::class)
                    ->name('export.xlsx');
            });

            Route::prefix('settings')->name('settings.')->group(function () {
                Route::get('', SettingsIndexController::class)
                    ->name('index');
            });

            Route::prefix('financial')->name('financial.')->group(function () {
                Route::get('', FinancialIndexController::class)
                    ->name('index');
            });

            Route::prefix('statistics')->name('statistics.')->group(function () {
                Route::get('', StatisticsIndexController::class)
                    ->name('index');
            });

            Route::prefix('zones')->name('zones.')->group(function () {
                Route::get('', ZonesIndexController::class)
                    ->name('index');

                Route::get('show/{zone}', ZoneShowController::class)
                    ->name('show');

                Route::put('{zone}', ZoneUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', ZoneStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{zone}', ZoneDeleteController::class)
                    ->name('destroy');
            });

            Route::prefix('occasions')->name('occasions.')->group(function () {
                Route::prefix('eid-al-adha')->name('eid-al-adha.')->group(function () {
                    Route::get('', EidAlAdhaIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportFamiliesEidAlAdhaPDF::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportFamiliesEidAlAdhaXlsxController::class)
                        ->name('export.xlsx');
                });

            });
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

    Route::put('settings', UpdateSettingsController::class)->name('settings.update');
});
