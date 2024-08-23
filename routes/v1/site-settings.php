<?php

use App\Http\Controllers\V1\SiteSettings\SiteSettingUpdateInfosController;
use App\Http\Controllers\V1\SiteSettings\UpdateCalculationWeightsController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::prefix('site-settings')->name('site-settings.')->group(function () {
    Route::put('update-infos', SiteSettingUpdateInfosController::class)->name('update-infos')->middleware([HandlePrecognitiveRequests::class]);

    Route::put('update-calculation-weights', UpdateCalculationWeightsController::class)->name('update-calculation-weights');
});
