<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;

class SaveToArchiveController extends Controller
{
    public function __invoke()
    {
        ray(request()->all(), 's13');

        saveToArchive(FILTER_RAMADAN_BASKET);
    }
}
