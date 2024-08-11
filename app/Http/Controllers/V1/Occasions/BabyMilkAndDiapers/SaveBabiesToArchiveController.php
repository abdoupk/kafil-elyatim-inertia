<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Http\Controllers\Controller;

class SaveBabiesToArchiveController extends Controller
{
    public function __invoke()
    {
        saveToArchive('babies_milk_and_diapers', function () {
            return getBabiesForExport();
        });
    }
}
