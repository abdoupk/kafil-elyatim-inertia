<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Landing\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageController::class);
