<?php

namespace App\Http\Controllers\V1\Occasions\MonthlyBasket;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class MonthlyBasketIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/occasions/monthly-basket/index/MonthlyBasketIndex', [
            'families' => listOfFamiliesBenefitingFromTheMonthlyBasket(),
        ]);
    }
}
