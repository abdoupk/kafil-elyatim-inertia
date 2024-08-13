<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Http\Controllers\Controller;
use App\Models\Baby;

class SaveBabiesToArchiveController extends Controller
{
    public function __invoke()
    {
        getBabiesForExport()->flatMap(function (Baby $baby) {
            saveToArchive('babies_milk_and_diapers', $baby);
        });
    }
}
