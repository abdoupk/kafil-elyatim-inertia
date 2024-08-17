<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Notifications\NotificationsIndexController;

Route::prefix('notifications')->name('notifications.')->group(function () {
    Route::get('', NotificationsIndexController::class)
        ->name('index');
});
