<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\V1\Branches\BranchDeleteController;
use App\Http\Controllers\V1\Branches\BranchesIndexController;
use App\Http\Controllers\V1\Branches\BranchShowController;
use App\Http\Controllers\V1\Branches\BranchStoreController;
use App\Http\Controllers\V1\Branches\BranchUpdateController;
use App\Http\Controllers\V1\Dashboard\DashboardController;
use App\Http\Controllers\V1\Events\LessonShowController;
use App\Http\Controllers\V1\Families\ExportFamiliesPDFController;
use App\Http\Controllers\V1\Families\ExportFamiliesXlsxController;
use App\Http\Controllers\V1\Families\FamiliesIndexController;
use App\Http\Controllers\V1\Families\FamilyCreateController;
use App\Http\Controllers\V1\Families\FamilyDeleteController;
use App\Http\Controllers\V1\Families\FamilyEditController;
use App\Http\Controllers\V1\Families\FamilyShowController;
use App\Http\Controllers\V1\Families\FamilyStoreController;
use App\Http\Controllers\V1\Financial\FinancialDeleteController;
use App\Http\Controllers\V1\Financial\FinancialIndexController;
use App\Http\Controllers\V1\Financial\FinancialShowController;
use App\Http\Controllers\V1\Financial\FinancialStoreController;
use App\Http\Controllers\V1\Financial\FinancialUpdateController;
use App\Http\Controllers\V1\Inventory\InventoryIndexController;
use App\Http\Controllers\V1\Inventory\ItemDeleteController;
use App\Http\Controllers\V1\Inventory\ItemShowController;
use App\Http\Controllers\V1\Inventory\ItemStoreController;
use App\Http\Controllers\V1\Inventory\ItemUpdateController;
use App\Http\Controllers\V1\Lessons\LessonDeleteController;
use App\Http\Controllers\V1\Lessons\LessonDetailsController;
use App\Http\Controllers\V1\Lessons\LessonsIndexController;
use App\Http\Controllers\V1\Lessons\LessonStoreController;
use App\Http\Controllers\V1\Lessons\LessonUpdateDatesController;
use App\Http\Controllers\V1\Lessons\ListOrphansController;
use App\Http\Controllers\V1\Members\MemberCreateController;
use App\Http\Controllers\V1\Members\MemberDeleteController;
use App\Http\Controllers\V1\Members\MemberShowController;
use App\Http\Controllers\V1\Members\MembersIndexController;
use App\Http\Controllers\V1\Members\MemberStoreController;
use App\Http\Controllers\V1\Members\MemberUpdateController;
use App\Http\Controllers\V1\Needs\GetOrphansController;
use App\Http\Controllers\V1\Needs\GetSponsorsController;
use App\Http\Controllers\V1\Needs\NeedDeleteController;
use App\Http\Controllers\V1\Needs\NeedShowController;
use App\Http\Controllers\V1\Needs\NeedsIndexController;
use App\Http\Controllers\V1\Needs\NeedStoreController;
use App\Http\Controllers\V1\Needs\NeedUpdateController;
use App\Http\Controllers\V1\Occasions\EidAlAdha\EidAlAdhaIndexController;
use App\Http\Controllers\V1\Occasions\EidAlAdha\ExportFamiliesEidAlAdhaPDF;
use App\Http\Controllers\V1\Occasions\EidAlAdha\ExportFamiliesEidAlAdhaXlsxController;
use App\Http\Controllers\V1\Occasions\EidSuit\EidSuitIndexController;
use App\Http\Controllers\V1\Occasions\EidSuit\ExportOrphansEidSuitPDF;
use App\Http\Controllers\V1\Occasions\EidSuit\ExportOrphansEidSuitXlsxController;
use App\Http\Controllers\V1\Occasions\RamadanBasket\ExportFamiliesRamadanBasketPDF;
use App\Http\Controllers\V1\Occasions\RamadanBasket\ExportFamiliesRamadanBasketXlsxController;
use App\Http\Controllers\V1\Occasions\RamadanBasket\RamadanBasketIndexController;
use App\Http\Controllers\V1\Occasions\SchoolEntry\SchoolEntryIndexController;
use App\Http\Controllers\V1\Orphans\ExportOrphansPDFController;
use App\Http\Controllers\V1\Orphans\ExportOrphansXlsxController;
use App\Http\Controllers\V1\Orphans\OrphanDeleteController;
use App\Http\Controllers\V1\Orphans\OrphanEditController;
use App\Http\Controllers\V1\Orphans\OrphanShowController;
use App\Http\Controllers\V1\Orphans\OrphansIndexController;
use App\Http\Controllers\V1\Orphans\OrphanUpdateInfosController;
use App\Http\Controllers\V1\Orphans\OrphanUpdateSponsorshipsController;
use App\Http\Controllers\V1\PrivateSchools\SchoolDeleteController;
use App\Http\Controllers\V1\PrivateSchools\SchoolShowController;
use App\Http\Controllers\V1\PrivateSchools\SchoolsIndexController;
use App\Http\Controllers\V1\PrivateSchools\SchoolStoreController;
use App\Http\Controllers\V1\PrivateSchools\SchoolUpdateController;
use App\Http\Controllers\V1\Roles\RolesIndexController;
use App\Http\Controllers\V1\Settings\SettingsIndexController;
use App\Http\Controllers\V1\Settings\UpdateSettingsController;
use App\Http\Controllers\V1\Sponsors\ExportSponsorsPDFController;
use App\Http\Controllers\V1\Sponsors\ExportSponsorsXlsxController;
use App\Http\Controllers\V1\Sponsors\SponsorDeleteController;
use App\Http\Controllers\V1\Sponsors\SponsorEditController;
use App\Http\Controllers\V1\Sponsors\SponsorShowController;
use App\Http\Controllers\V1\Sponsors\SponsorsIndexController;
use App\Http\Controllers\V1\Sponsors\SponsorUpdateIncomesController;
use App\Http\Controllers\V1\Sponsors\SponsorUpdateInfosController;
use App\Http\Controllers\V1\Sponsors\SponsorUpdateSponsorshipsController;
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

                Route::put('infos/{orphan}', OrphanUpdateInfosController::class)
                    ->name('infos-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('sponsorships/{orphan}', OrphanUpdateSponsorshipsController::class)
                    ->name('sponsorships-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::get('edit/{orphan}', OrphanEditController::class)
                    ->name('edit');

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

                Route::get('show/{sponsor}', SponsorShowController::class)
                    ->name('show');

                Route::put('infos/{sponsor}', SponsorUpdateInfosController::class)
                    ->name('infos-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('incomes/{sponsor}', SponsorUpdateIncomesController::class)
                    ->name('incomes-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('sponsorships/{sponsor}', SponsorUpdateSponsorshipsController::class)
                    ->name('sponsorships-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::get('edit/{sponsor}', SponsorEditController::class)
                    ->name('edit');

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

                Route::get('show/{finance}', FinancialShowController::class)
                    ->name('show');

                Route::put('{finance}', FinancialUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', FinancialStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{finance}', FinancialDeleteController::class)
                    ->name('destroy');
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

                Route::prefix('school-entry')->name('school-entry.')->group(function () {
                    Route::get('', SchoolEntryIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportOrphansPDFController::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportOrphansXlsxController::class)
                        ->name('export.xlsx');
                });

                Route::prefix('ramadan-basket')->name('ramadan-basket.')->group(function () {
                    Route::get('', RamadanBasketIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportFamiliesRamadanBasketPDF::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportFamiliesRamadanBasketXlsxController::class)
                        ->name('export.xlsx');
                });

                Route::prefix('eid-suit')->name('eid-suit.')->group(function () {
                    Route::get('', EidSuitIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportOrphansEidSuitPDF::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportOrphansEidSuitXlsxController::class)
                        ->name('export.xlsx');
                });
            });

            Route::prefix('needs')->name('needs.')->group(function () {
                Route::get('', NeedsIndexController::class)
                    ->name('index');

                Route::get('show/{need}', NeedShowController::class)
                    ->name('show');

                Route::put('{need}', NeedUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', NeedStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{need}', NeedDeleteController::class)
                    ->name('destroy');

                Route::get('get-orphans', GetOrphansController::class)->name('get-orphans');

                Route::get('get-sponsors', GetSponsorsController::class)->name('get-sponsors');
            });

            Route::prefix('lessons')->name('lessons.')->group(function () {
                Route::get('', LessonsIndexController::class)
                    ->name('index');

                Route::get('list-orphans', ListOrphansController::class)
                    ->name('list-orphans');

                Route::post('', LessonStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('{lesson}', LessonUpdateDatesController::class)
                    ->name('update-dates');

                Route::get('edit/{eventOccurrence}', LessonDetailsController::class)
                    ->name('edit');

                Route::get('show/{eventOccurrence}', LessonShowController::class)
                    ->name('show');

                Route::delete('{lesson}', LessonDeleteController::class)
                    ->name('destroy');
            });

            Route::prefix('schools')->name('schools.')->group(function () {
                Route::get('', SchoolsIndexController::class)
                    ->name('index');

                Route::post('', SchoolStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('{school}', SchoolUpdateController::class)
                    ->name('update');

                Route::get('show/{school}', SchoolShowController::class)
                    ->name('show');

                Route::delete('{school}', SchoolDeleteController::class)
                    ->name('destroy');
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
