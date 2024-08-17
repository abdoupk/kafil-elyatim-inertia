<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Archive\ArchiveDetailsBabiesMilkAndDiapersController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsEidAlAdhaController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsEidSuitController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsMonthlyBasketController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsRamadanBasketController;
use App\Http\Controllers\V1\Archive\ArchiveDetailsSchoolEntryController;
use App\Http\Controllers\V1\Archive\ArchiveIndexController;
use App\Http\Controllers\V1\Archive\ExportArchiveFamiliesEidAlAdhaPDFController;
use App\Http\Controllers\V1\Archive\ExportArchiveFamiliesEidAlAdhaXlsxController;

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
