<?php

namespace App\Http\Controllers\V1\Occasions\RamadanBasket;

use App\Http\Controllers\Controller;

class SaveFamiliesRamadanBasketToArchiveController extends Controller
{
    public function __invoke()
    {
        saveToArchive('ramadan_basket', function () {
            return listOfFamiliesBenefitingFromTheRamadanBasketSponsorshipForExport();
        });
    }
}
