<?php

namespace App\Http\Controllers\V1\Occasions\MonthlyBasket;

use App\Http\Controllers\Controller;

class SaveFamiliesMonthlyBasketToArchiveController extends Controller
{
    public function __invoke()
    {
        saveToArchive('monthly_basket', function () {
            return listOfFamiliesBenefitingFromTheMonthlyBasketForExport();
        });
    }
}
