<?php

namespace App\Http\Controllers\V1\Occasions\RamadanBasket;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\FamilySponsorship;

class SaveFamiliesRamadanBasketToArchiveController extends Controller
{
    public function __invoke()
    {
        Archive::where('occasion', '=', 'ramadan_basket')
            ->whereYear('created_at', '=', now()->year)->firstOrCreate([
                'occasion' => 'ramadan_basket',
                'saved_by' => auth()->user()->id,
            ])
            ->families()
            ->syncWithPivotValues(listOfFamiliesBenefitingFromTheRamadanBasketSponsorshipForExport()->map(function (FamilySponsorship $sponsorship) {
                return $sponsorship->family->id;
            }), ['tenant_id' => tenant('id')]);
    }
}
