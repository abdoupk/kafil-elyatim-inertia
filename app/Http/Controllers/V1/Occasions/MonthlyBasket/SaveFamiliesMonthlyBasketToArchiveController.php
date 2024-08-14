<?php

namespace App\Http\Controllers\V1\Occasions\MonthlyBasket;

use App\Http\Controllers\Controller;
use App\Models\Archive;

class SaveFamiliesMonthlyBasketToArchiveController extends Controller
{
    public function __invoke()
    {
        Archive::where('occasion', '=', 'monthly_basket')
            ->whereMonth('created_at', '=', now()->month)->firstOrCreate([
                'occasion' => 'monthly_basket',
                'saved_by' => auth()->user()->id,
            ])
            ->families()
            ->syncWithPivotValues(listOfFamiliesBenefitingFromTheMonthlyBasketForExport()->pluck('id'), ['tenant_id' => tenant('id')]);
    }
}
