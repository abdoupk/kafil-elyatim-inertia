<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Settings\SettingsIndexController;

Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('', SettingsIndexController::class)
        ->name('index');
});
