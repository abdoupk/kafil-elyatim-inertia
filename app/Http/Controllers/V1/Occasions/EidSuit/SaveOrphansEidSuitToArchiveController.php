<?php

namespace App\Http\Controllers\V1\Occasions\EidSuit;

use App\Http\Controllers\Controller;
use App\Models\Archive;

class SaveOrphansEidSuitToArchiveController extends Controller
{
    public function __invoke()
    {
        ray(listOfOrphansBenefitingFromTheEidSuitSponsorshipForExport()->pluck('id'));
        Archive::where('occasion', '=', 'eid_suit')
            ->whereMonth('created_at', '=', now()->month)->firstOrCreate(['occasion' => 'eid_suit', 'saved_by' => auth()->user()->id])->orphans()->syncWithPivotValues(listOfOrphansBenefitingFromTheEidSuitSponsorshipForExport()->pluck('id'), ['tenant_id' => tenant('id')]);
        //        Archive::where('occasion', '=', 'eid_suit')
        //            ->whereMonth('created_at', '=', now()->month)->first()->orphans()->attach(listOfOrphansBenefitingFromTheEidSuitSponsorshipForExport()->pluck('id'));
    }
}
