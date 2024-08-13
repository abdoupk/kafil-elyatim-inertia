<?php

namespace App\Http\Controllers\V1\Occasions\RamadanBasket;

use App\Http\Controllers\Controller;
use App\Models\FamilySponsorship;

class SaveFamiliesRamadanBasketToArchiveController extends Controller
{
    public function __invoke()
    {
        listOfFamiliesBenefitingFromTheRamadanBasketSponsorshipForExport()->flatMap(function (FamilySponsorship $familySponsorShip) {
            saveToArchive('ramadan_basket', $familySponsorShip);
        });
    }
}
