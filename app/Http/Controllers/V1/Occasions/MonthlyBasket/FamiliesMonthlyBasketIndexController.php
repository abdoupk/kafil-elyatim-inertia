<?php

namespace App\Http\Controllers\V1\Occasions\MonthlyBasket;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\MonthlyBasketResource;
use App\Models\Archive;
use Inertia\Inertia;

class FamiliesMonthlyBasketIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/monthly-basket/MonthlyBasketIndex', [
            'families' => MonthlyBasketResource::collection(listOfFamiliesBenefitingFromTheMonthlyBasket()),
            'params' => getParams(),
            'archive' => fn () => Archive::with('savedBy:id,first_name,last_name')->whereOccasion('monthly_basket')
                ->whereMonth('created_at', now()->format('m-Y'))->select(['id', 'saved_by', 'created_at'])->first(),
        ]);
    }
}
