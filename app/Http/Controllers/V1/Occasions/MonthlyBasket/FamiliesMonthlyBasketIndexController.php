<?php

namespace App\Http\Controllers\V1\Occasions\MonthlyBasket;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\MonthlyBasketResource;
use Inertia\Inertia;

class FamiliesMonthlyBasketIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/monthly-basket/MonthlyBasketIndex', [
            'families' => MonthlyBasketResource::collection(listOfFamiliesBenefitingFromTheMonthlyBasket()),
            'params' => getParams(),
        ]);
    }
}
