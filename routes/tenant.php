<?php

declare(strict_types=1);

use App\Http\Controllers\V1\AcademicAchievements\AcademicAchievementsDeleteController;
use App\Http\Controllers\V1\AcademicAchievements\AcademicAchievementsShowController;
use App\Http\Controllers\V1\AcademicAchievements\AcademicAchievementsStoreController;
use App\Http\Controllers\V1\AcademicAchievements\AcademicAchievementsUpdateController;
use App\Http\Controllers\V1\AcademicLevel\AcademicLevelIndexController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsBabiesMilkAndDiapersController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsEidAlAdhaController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsEidSuitController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsMonthlyBasketController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsRamadanBasketController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsSchoolEntryController;
use App\Http\Controllers\V1\Archive\ArchiveIndexController;
use App\Http\Controllers\V1\Archive\ExportArchiveFamiliesEidAlAdhaPDFController;
use App\Http\Controllers\V1\Archive\ExportArchiveFamiliesEidAlAdhaXlsxController;
use App\Http\Controllers\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\V1\Auth\PasswordController;
use App\Http\Controllers\V1\Branches\BranchDeleteController;
use App\Http\Controllers\V1\Branches\BranchDetailsController;
use App\Http\Controllers\V1\Branches\BranchesIndexController;
use App\Http\Controllers\V1\Branches\BranchForceDeleteController;
use App\Http\Controllers\V1\Branches\BranchRestoreController;
use App\Http\Controllers\V1\Branches\BranchShowController;
use App\Http\Controllers\V1\Branches\BranchStoreController;
use App\Http\Controllers\V1\Branches\BranchUpdateController;
use App\Http\Controllers\V1\Branches\ListBranchesController;
use App\Http\Controllers\V1\CollegeAchievements\CollegeAchievementsDeleteController;
use App\Http\Controllers\V1\CollegeAchievements\CollegeAchievementsShowController;
use App\Http\Controllers\V1\CollegeAchievements\CollegeAchievementsStoreController;
use App\Http\Controllers\V1\CollegeAchievements\CollegeAchievementsUpdateController;
use App\Http\Controllers\V1\Dashboard\DashboardController;
use App\Http\Controllers\V1\Events\LessonShowController;
use App\Http\Controllers\V1\Families\ExportFamiliesPDFController;
use App\Http\Controllers\V1\Families\ExportFamiliesXlsxController;
use App\Http\Controllers\V1\Families\FamiliesIndexController;
use App\Http\Controllers\V1\Families\FamiliesStatisticsController;
use App\Http\Controllers\V1\Families\FamilyCreateController;
use App\Http\Controllers\V1\Families\FamilyDeleteController;
use App\Http\Controllers\V1\Families\FamilyEditController;
use App\Http\Controllers\V1\Families\FamilyForceDeleteController;
use App\Http\Controllers\V1\Families\FamilyRestoreController;
use App\Http\Controllers\V1\Families\FamilyShowController;
use App\Http\Controllers\V1\Families\FamilyStoreController;
use App\Http\Controllers\V1\Families\FamilyUpdateFurnishingsController;
use App\Http\Controllers\V1\Families\FamilyUpdateHousingController;
use App\Http\Controllers\V1\Families\FamilyUpdateInfoController;
use App\Http\Controllers\V1\Families\FamilyUpdateReportController;
use App\Http\Controllers\V1\Families\FamilyUpdateSecondSponsorController;
use App\Http\Controllers\V1\Families\FamilyUpdateSponsorShipsController;
use App\Http\Controllers\V1\Families\FamilyUpdateSpouseController;
use App\Http\Controllers\V1\Families\SearchFamiliesController;
use App\Http\Controllers\V1\Financial\FinancialDeleteController;
use App\Http\Controllers\V1\Financial\FinancialForceDeleteController;
use App\Http\Controllers\V1\Financial\FinancialIndexController;
use App\Http\Controllers\V1\Financial\FinancialRestoreController;
use App\Http\Controllers\V1\Financial\FinancialShowController;
use App\Http\Controllers\V1\Financial\FinancialStatisticsController;
use App\Http\Controllers\V1\Financial\FinancialStoreController;
use App\Http\Controllers\V1\Financial\FinancialUpdateController;
use App\Http\Controllers\V1\Inventory\InventoryIndexController;
use App\Http\Controllers\V1\Inventory\ItemDeleteController;
use App\Http\Controllers\V1\Inventory\ItemDetailsController;
use App\Http\Controllers\V1\Inventory\ItemShowController;
use App\Http\Controllers\V1\Inventory\ItemStoreController;
use App\Http\Controllers\V1\Inventory\ItemUpdateController;
use App\Http\Controllers\V1\Lessons\LessonDeleteController;
use App\Http\Controllers\V1\Lessons\LessonDetailsController;
use App\Http\Controllers\V1\Lessons\LessonsIndexController;
use App\Http\Controllers\V1\Lessons\LessonStoreController;
use App\Http\Controllers\V1\Lessons\LessonUpdateController;
use App\Http\Controllers\V1\Lessons\LessonUpdateDatesController;
use App\Http\Controllers\V1\Lessons\ListOrphansController;
use App\Http\Controllers\V1\List\ListClothesSizesController;
use App\Http\Controllers\V1\List\ListRolesController;
use App\Http\Controllers\V1\List\ListShoesSizesController;
use App\Http\Controllers\V1\List\ListSubjectsController;
use App\Http\Controllers\V1\Members\ListBabyMilkController;
use App\Http\Controllers\V1\Members\ListDiapersController;
use App\Http\Controllers\V1\Members\ListMembersController;
use App\Http\Controllers\V1\Members\ListSchoolsController;
use App\Http\Controllers\V1\Members\MemberDeleteController;
use App\Http\Controllers\V1\Members\MemberDetailsController;
use App\Http\Controllers\V1\Members\MemberForceDeleteController;
use App\Http\Controllers\V1\Members\MemberRestoreController;
use App\Http\Controllers\V1\Members\MemberShowController;
use App\Http\Controllers\V1\Members\MembersIndexController;
use App\Http\Controllers\V1\Members\MemberStoreController;
use App\Http\Controllers\V1\Members\MemberUpdateController;
use App\Http\Controllers\V1\Needs\GetOrphansController;
use App\Http\Controllers\V1\Needs\NeedDeleteController;
use App\Http\Controllers\V1\Needs\NeedDetailsController;
use App\Http\Controllers\V1\Needs\NeedForceDeleteController;
use App\Http\Controllers\V1\Needs\NeedRestoreController;
use App\Http\Controllers\V1\Needs\NeedShowController;
use App\Http\Controllers\V1\Needs\NeedsIndexController;
use App\Http\Controllers\V1\Needs\NeedStoreController;
use App\Http\Controllers\V1\Needs\NeedUpdateController;
use App\Http\Controllers\V1\Notifications\NotificationsIndexController;
use App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers\BabyMilkAndDiapersIndexController;
use App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers\ExportBabiesPDFController;
use App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers\ExportBabiesXlsxController;
use App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers\SaveBabiesToArchiveController;
use App\Http\Controllers\V1\Occasions\EidAlAdha\EidAlAdhaIndexController;
use App\Http\Controllers\V1\Occasions\EidAlAdha\ExportFamiliesEidAlAdhaPDFController;
use App\Http\Controllers\V1\Occasions\EidAlAdha\ExportFamiliesEidAlAdhaXlsxController;
use App\Http\Controllers\V1\Occasions\EidAlAdha\SaveFamiliesEidAlAdhaToArchiveController;
use App\Http\Controllers\V1\Occasions\EidSuit\EidSuitIndexController;
use App\Http\Controllers\V1\Occasions\EidSuit\ExportOrphansEidSuitPDFController;
use App\Http\Controllers\V1\Occasions\EidSuit\ExportOrphansEidSuitXlsxController;
use App\Http\Controllers\V1\Occasions\EidSuit\SaveOrphansEidSuitToArchiveController;
use App\Http\Controllers\V1\Occasions\MonthlyBasket\ExportFamiliesMonthlyBasketPDFController;
use App\Http\Controllers\V1\Occasions\MonthlyBasket\ExportFamiliesMonthlyBasketXlsxController;
use App\Http\Controllers\V1\Occasions\MonthlyBasket\FamiliesMonthlyBasketIndexController;
use App\Http\Controllers\V1\Occasions\MonthlyBasket\SaveFamiliesMonthlyBasketToArchiveController;
use App\Http\Controllers\V1\Occasions\RamadanBasket\ExportFamiliesRamadanBasketPDFController;
use App\Http\Controllers\V1\Occasions\RamadanBasket\ExportFamiliesRamadanBasketXlsxController;
use App\Http\Controllers\V1\Occasions\RamadanBasket\RamadanBasketIndexController;
use App\Http\Controllers\V1\Occasions\RamadanBasket\SaveFamiliesRamadanBasketToArchiveController;
use App\Http\Controllers\V1\Occasions\SchoolEntry\ExportOrphansSchoolEntryPDFController;
use App\Http\Controllers\V1\Occasions\SchoolEntry\ExportOrphansSchoolEntryXlsxController;
use App\Http\Controllers\V1\Occasions\SchoolEntry\SaveOrphansSchoolEntryToArchiveController;
use App\Http\Controllers\V1\Occasions\SchoolEntry\SchoolEntryIndexController;
use App\Http\Controllers\V1\Orphans\ExportOrphansPDFController;
use App\Http\Controllers\V1\Orphans\ExportOrphansXlsxController;
use App\Http\Controllers\V1\Orphans\OrphanDeleteController;
use App\Http\Controllers\V1\Orphans\OrphanEditController;
use App\Http\Controllers\V1\Orphans\OrphanForceDeleteController;
use App\Http\Controllers\V1\Orphans\OrphanRestoreController;
use App\Http\Controllers\V1\Orphans\OrphanShowController;
use App\Http\Controllers\V1\Orphans\OrphansIndexController;
use App\Http\Controllers\V1\Orphans\OrphansStatisticsController;
use App\Http\Controllers\V1\Orphans\OrphanUpdateInfosController;
use App\Http\Controllers\V1\Orphans\OrphanUpdateSponsorshipsController;
use App\Http\Controllers\V1\Orphans\SearchOrphansController;
use App\Http\Controllers\V1\PrivateSchools\SchoolDeleteController;
use App\Http\Controllers\V1\PrivateSchools\SchoolDetailsController;
use App\Http\Controllers\V1\PrivateSchools\SchoolForceDeleteController;
use App\Http\Controllers\V1\PrivateSchools\SchoolRestoreController;
use App\Http\Controllers\V1\PrivateSchools\SchoolShowController;
use App\Http\Controllers\V1\PrivateSchools\SchoolsIndexController;
use App\Http\Controllers\V1\PrivateSchools\SchoolStoreController;
use App\Http\Controllers\V1\PrivateSchools\SchoolUpdateController;
use App\Http\Controllers\V1\ProfileController;
use App\Http\Controllers\V1\Roles\RoleDeleteController;
use App\Http\Controllers\V1\Roles\RoleShowController;
use App\Http\Controllers\V1\Roles\RolesIndexController;
use App\Http\Controllers\V1\Roles\RoleStoreController;
use App\Http\Controllers\V1\Roles\RoleUpdateController;
use App\Http\Controllers\V1\Settings\SettingsIndexController;
use App\Http\Controllers\V1\Settings\UpdateNotificationsSettingsController;
use App\Http\Controllers\V1\Settings\UpdateSettingsController;
use App\Http\Controllers\V1\Sponsors\ExportSponsorsPDFController;
use App\Http\Controllers\V1\Sponsors\ExportSponsorsXlsxController;
use App\Http\Controllers\V1\Sponsors\SearchSponsorsController;
use App\Http\Controllers\V1\Sponsors\SponsorDeleteController;
use App\Http\Controllers\V1\Sponsors\SponsorEditController;
use App\Http\Controllers\V1\Sponsors\SponsorForceDeleteController;
use App\Http\Controllers\V1\Sponsors\SponsorRestoreController;
use App\Http\Controllers\V1\Sponsors\SponsorShowController;
use App\Http\Controllers\V1\Sponsors\SponsorsIndexController;
use App\Http\Controllers\V1\Sponsors\SponsorsStatisticsController;
use App\Http\Controllers\V1\Sponsors\SponsorUpdateIncomesController;
use App\Http\Controllers\V1\Sponsors\SponsorUpdateInfosController;
use App\Http\Controllers\V1\Sponsors\SponsorUpdateSponsorshipsController;
use App\Http\Controllers\V1\Statistics\StatisticsIndexController;
use App\Http\Controllers\V1\Trash\TrashIndexController;
use App\Http\Controllers\V1\VocationalTraining\VocationalTrainingIndexController;
use App\Http\Controllers\V1\VocationalTrainingAchievements\VocationalTrainingAchievementsDeleteController;
use App\Http\Controllers\V1\VocationalTrainingAchievements\VocationalTrainingAchievementsShowController;
use App\Http\Controllers\V1\VocationalTrainingAchievements\VocationalTrainingAchievementsStoreController;
use App\Http\Controllers\V1\VocationalTrainingAchievements\VocationalTrainingAchievementsUpdateController;
use App\Http\Controllers\V1\Zones\ListZonesController;
use App\Http\Controllers\V1\Zones\ZoneDeleteController;
use App\Http\Controllers\V1\Zones\ZoneDetailsController;
use App\Http\Controllers\V1\Zones\ZoneForceDeleteController;
use App\Http\Controllers\V1\Zones\ZoneRestoreController;
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
            // Logout route
            Route::post(
                'logout',
                [AuthenticatedSessionController::class, 'destroy']
            )->name('logout');

            Route::prefix('profile')->name('profile.')->group(function () {
                Route::get('/', [ProfileController::class, 'edit'])->name('edit');

                Route::patch('/', [ProfileController::class, 'update'])->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');

                Route::put('password', [PasswordController::class, 'update'])->name('password.update');

                Route::put('settings', UpdateSettingsController::class)->name('settings.update');

                Route::put('notifications', UpdateNotificationsSettingsController::class)->name('notifications.update');
            });

            Route::prefix('list')->name('list.')->group(function () {
                Route::get('shoes-sizes', ListShoesSizesController::class)->name('shoes-sizes');

                Route::get('clothes-sizes', ListClothesSizesController::class)->name('clothes-sizes');

                Route::get('roles', ListRolesController::class)->name('roles');

                Route::get('members', ListMembersController::class)->name('members');

                Route::get('subjects', ListSubjectsController::class)->name('subjects');

                Route::get('schools', ListSchoolsController::class)->name('schools');

                Route::get('list-branches', ListBranchesController::class)->name('branches');

                Route::get('list-zones', ListZonesController::class)->name('zones');

                Route::get('baby-milk', ListBabyMilkController::class)->name('baby-milk');

                Route::get('diapers', ListDiapersController::class)->name('diapers');
            });

            Route::get('', DashboardController::class)
                ->name('dashboard');

            Route::prefix('families')->name('families.')->group(function () {
                Route::get('', FamiliesIndexController::class)
                    ->name('index');

                Route::get('/create', FamilyCreateController::class)
                    ->name('create');

                Route::post('', FamilyStoreController::class)
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

                Route::get('search', SearchFamiliesController::class)
                    ->name('search');

                Route::put('infos/{family}', FamilyUpdateInfoController::class)->name('infos-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('spouse/{family}', FamilyUpdateSpouseController::class)->name('spouse-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('report/{family}', FamilyUpdateReportController::class)->name('report-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('second-sponsor/{family}', FamilyUpdateSecondSponsorController::class)->name('second-sponsor-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('housing/{family}', FamilyUpdateHousingController::class)->name('housing-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('furnishings/{family}', FamilyUpdateFurnishingsController::class)->name('furnishings-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('sponsorships/{family}', FamilyUpdateSponsorShipsController::class)->name('sponsorships-update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('{family}/restore', FamilyRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{family}/force-delete', FamilyForceDeleteController::class)
                    ->name('force-delete')->withTrashed();

                Route::get('statistics', FamiliesStatisticsController::class)
                    ->name('statistics');
            });

            Route::prefix('inventory')->group(function () {
                Route::get('', InventoryIndexController::class)
                    ->name('inventory.index');

                Route::post('', ItemStoreController::class)
                    ->name('items.store')->middleware([HandlePrecognitiveRequests::class]);

                Route::get('show/{item}', ItemShowController::class)
                    ->name('items.show');

                Route::get('details/{item}', ItemDetailsController::class)
                    ->name('items.details');

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

                Route::get('details/{branch}', BranchDetailsController::class)
                    ->name('details');

                Route::put('{branch}', BranchUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', BranchStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{branch}', BranchDeleteController::class)
                    ->name('destroy');

                Route::post('{branch}/restore', BranchRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{branch}/force-delete', BranchForceDeleteController::class)
                    ->name('force-delete')->withTrashed();
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

                Route::get('search', SearchOrphansController::class)
                    ->name('search');

                Route::post('{orphan}/restore', OrphanRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{orphan}/force-delete', OrphanForceDeleteController::class)
                    ->name('force-delete')->withTrashed();

                Route::get('statistics', OrphansStatisticsController::class)
                    ->name('statistics');
            });

            Route::prefix('members')->name('members.')->group(function () {
                Route::get('', MembersIndexController::class)
                    ->name('index');

                Route::get('show/{member}', MemberShowController::class)
                    ->name('show');

                Route::get('details/{member}', MemberDetailsController::class)
                    ->name('details');

                Route::put('{member}', MemberUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', MemberStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{member}', MemberDeleteController::class)
                    ->name('destroy');

                Route::post('{member}/restore', MemberRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{member}/force-delete', MemberForceDeleteController::class)
                    ->name('force-delete')->withTrashed();
            });

            Route::prefix('roles')->name('roles.')->group(function () {
                Route::get('', RolesIndexController::class)
                    ->name('index');

                Route::post('', RoleStoreController::class)
                    ->name('store');

                Route::put('{role}', RoleUpdateController::class)
                    ->name('update');

                Route::get('show/{role}', RoleShowController::class)
                    ->name('show');

                Route::delete('{role}', RoleDeleteController::class)
                    ->name('destroy');
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

                Route::get('search', SearchSponsorsController::class)
                    ->name('search');

                Route::post('{sponsor}/restore', SponsorRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{sponsor}/force-delete', SponsorForceDeleteController::class)
                    ->name('force-delete')->withTrashed();

                Route::get('statistics', SponsorsStatisticsController::class)
                    ->name('statistics');
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

                Route::post('{finance}/restore', FinancialRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{finance}/force-delete', FinancialForceDeleteController::class)
                    ->name('force-delete')->withTrashed();

                Route::get('statistics', FinancialStatisticsController::class)
                    ->name('statistics');
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

                Route::get('details/{zone}', ZoneDetailsController::class)
                    ->name('details');

                Route::put('{zone}', ZoneUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', ZoneStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{zone}', ZoneDeleteController::class)
                    ->name('destroy');

                Route::post('{zone}/restore', ZoneRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{zone}/force-delete', ZoneForceDeleteController::class)
                    ->name('force-delete')->withTrashed();
            });

            Route::prefix('occasions')->name('occasions.')->group(function () {
                Route::prefix('eid-al-adha')->name('eid-al-adha.')->group(function () {
                    Route::get('', EidAlAdhaIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportFamiliesEidAlAdhaPDFController::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportFamiliesEidAlAdhaXlsxController::class)
                        ->name('export.xlsx');

                    Route::get('save-to-archive', SaveFamiliesEidAlAdhaToArchiveController::class)->name('save-to-archive');
                });

                Route::prefix('school-entry')->name('school-entry.')->group(function () {
                    Route::get('', SchoolEntryIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportOrphansSchoolEntryPDFController::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportOrphansSchoolEntryXlsxController::class)
                        ->name('export.xlsx');

                    Route::get('save-to-archive', SaveOrphansSchoolEntryToArchiveController::class)->name('save-to-archive');
                });

                Route::prefix('ramadan-basket')->name('ramadan-basket.')->group(function () {
                    Route::get('', RamadanBasketIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportFamiliesRamadanBasketPDFController::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportFamiliesRamadanBasketXlsxController::class)
                        ->name('export.xlsx');

                    Route::get('save-to-archive', SaveFamiliesRamadanBasketToArchiveController::class)->name('save-to-archive');
                });

                Route::prefix('eid-suit')->name('eid-suit.')->group(function () {
                    Route::get('', EidSuitIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportOrphansEidSuitPDFController::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportOrphansEidSuitXlsxController::class)
                        ->name('export.xlsx');

                    Route::get('save-to-archive', SaveOrphansEidSuitToArchiveController::class)->name('save-to-archive');
                });

                Route::prefix('monthly-basket')->name('monthly-basket.')->group(function () {
                    Route::get('', FamiliesMonthlyBasketIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportFamiliesMonthlyBasketPDFController::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportFamiliesMonthlyBasketXlsxController::class)
                        ->name('export.xlsx');

                    Route::get('save-to-archive', SaveFamiliesMonthlyBasketToArchiveController::class)->name('save-to-archive');
                });

                Route::prefix('babies-milk-and-diapers')->name('babies-milk-and-diapers.')->group(function () {
                    Route::get('', BabyMilkAndDiapersIndexController::class)
                        ->name('index');

                    Route::get('export-pdf', ExportBabiesPDFController::class)
                        ->name('export.pdf');

                    Route::get('export-xlsx', ExportBabiesXlsxController::class)
                        ->name('export.xlsx');

                    Route::get('save-to-archive', SaveBabiesToArchiveController::class)->name('save-to-archive');
                });
            });

            Route::prefix('needs')->name('needs.')->group(function () {
                Route::get('', NeedsIndexController::class)
                    ->name('index');

                Route::get('show/{need}', NeedShowController::class)
                    ->name('show');

                Route::get('details/{need}', NeedDetailsController::class)
                    ->name('details');

                Route::put('{need}', NeedUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

                Route::post('', NeedStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{need}', NeedDeleteController::class)
                    ->name('destroy');

                Route::post('{need}/restore', NeedRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{need}/force-delete', NeedForceDeleteController::class)
                    ->name('force-delete')->withTrashed();

                Route::get('get-orphans', GetOrphansController::class)->name('get-orphans');
            });

            Route::prefix('lessons')->name('lessons.')->group(function () {
                Route::get('', LessonsIndexController::class)
                    ->name('index');

                Route::get('list-orphans', ListOrphansController::class)
                    ->name('list-orphans');

                Route::post('', LessonStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('{eventOccurrence}', LessonUpdateController::class)
                    ->name('update')->middleware([HandlePrecognitiveRequests::class]);

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

                Route::get('details/{school}', SchoolDetailsController::class)
                    ->name('details');

                Route::delete('{school}', SchoolDeleteController::class)
                    ->name('destroy');

                Route::post('{school}/restore', SchoolRestoreController::class)
                    ->name('restore')->withTrashed();

                Route::delete('{school}/force-delete', SchoolForceDeleteController::class)
                    ->name('force-delete')->withTrashed();
            });

            Route::prefix('notifications')->name('notifications.')->group(function () {
                Route::get('', NotificationsIndexController::class)
                    ->name('index');
            });

            Route::prefix('academic-achievements')->name('academic-achievements.')->group(function () {
                Route::get('show/{academicAchievement}', AcademicAchievementsShowController::class)
                    ->name('show');

                Route::post('', AcademicAchievementsStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('{academicAchievement}', AcademicAchievementsUpdateController::class)
                    ->name('update')
                    ->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{academicAchievement}', AcademicAchievementsDeleteController::class)
                    ->name('destroy');
            });

            Route::prefix('college-achievements')->name('college-achievements.')->group(function () {
                Route::get('show/{collegeAchievement}', CollegeAchievementsShowController::class)
                    ->name('show');

                Route::post('', CollegeAchievementsStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('{collegeAchievement}', CollegeAchievementsUpdateController::class)
                    ->name('update')
                    ->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{collegeAchievement}', CollegeAchievementsDeleteController::class)
                    ->name('destroy');
            });

            Route::prefix('vocational-training-achievements')->name('vocational-training-achievements.')->group(function () {
                Route::get('show/{vocationalTrainingAchievement}', VocationalTrainingAchievementsShowController::class)
                    ->name('show');

                Route::post('', VocationalTrainingAchievementsStoreController::class)
                    ->name('store')->middleware([HandlePrecognitiveRequests::class]);

                Route::put('{vocationalTrainingAchievement}', VocationalTrainingAchievementsUpdateController::class)
                    ->name('update')
                    ->middleware([HandlePrecognitiveRequests::class]);

                Route::delete('{vocationalTrainingAchievement}', VocationalTrainingAchievementsDeleteController::class)
                    ->name('destroy');
            });

            Route::get('academic-levels', AcademicLevelIndexController::class)->name('list-academic-levels');

            Route::get('vocational-training', VocationalTrainingIndexController::class)->name('list-vocational-trainings-specialities');

            Route::get('trash', TrashIndexController::class)->name('trash');

            Route::prefix('archive')->name('archive.')->group(function () {
                Route::get('', ArchiveIndexController::class)->name('index');

                Route::prefix('details')->name('details.')->group(function () {
                    Route::get('eid-al-adha/{archive}', ArchiveDetailsEidAlAdhaController::class)->name('eid-al-adha');

                    Route::get('monthly-basket/{archive}', ArchiveDetailsMonthlyBasketController::class)->name('monthly-basket');

                    Route::get('ramadan-basket/{archive}', ArchiveDetailsRamadanBasketController::class)->name('ramadan-basket');

                    Route::get('school-entry/{archive}', ArchiveDetailsSchoolEntryController::class)->name('school-entry');

                    Route::get('eid-suit/{archive}', ArchiveDetailsEidSuitController::class)->name('eid-suit');

                    Route::get('babies-milk-and-diapers/{archive}', ArchiveDetailsBabiesMilkAndDiapersController::class)->name('babies-milk-and-diapers');
                });

                Route::prefix('export')->name('export.')->group(function () {
                    Route::get('eid-al-adha/pdf/{archive}', ExportArchiveFamiliesEidAlAdhaPDFController::class)->name('eid-al-adha.pdf');

                    Route::get('eid-al-adha/xlsx/{archive}', ExportArchiveFamiliesEidAlAdhaXlsxController::class)->name('eid-al-adha.xlsx');

                    //                    Route::get('monthly-basket/{archive}', ArchiveDetailsMonthlyBasketController::class)->name('monthly-basket');
                    //
                    //                    Route::get('ramadan-basket/{archive}', ArchiveDetailsRamadanBasketController::class)->name('ramadan-basket');
                    //
                    //                    Route::get('school-entry/{archive}', ArchiveDetailsSchoolEntryController::class)->name('school-entry');
                    //
                    //                    Route::get('eid-suit/{archive}', ArchiveDetailsEidSuitController::class)->name('eid-suit');
                    //
                    //                    Route::get('babies-milk-and-diapers/{archive}', ArchiveDetailsBabiesMilkAndDiapersController::class)->name('babies-milk-and-diapers');
                });
            });
        });
    });
});
