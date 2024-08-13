<?php

namespace App\Http\Controllers\V1\Occasions\MonthlyBasket;

use App\Http\Controllers\Controller;
use App\Models\FamilySponsorship;

class SaveFamiliesMonthlyBasketToArchiveController extends Controller
{
    public function __invoke()
    {
        listOfFamiliesBenefitingFromTheMonthlyBasketForExport()->flatMap(function (FamilySponsorship $familySponsorShip) {
            saveToArchive('monthly_basket', $familySponsorShip);
        });
    }
}
