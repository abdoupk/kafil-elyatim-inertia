<?php

namespace App\Http\Controllers\V1\Occasions\EidSuit;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\EidSuitResource;
use App\Models\Archive;
use Inertia\Inertia;

class EidSuitIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/eid-suit/EidSuitIndex', [
            'orphans' => EidSuitResource::collection(listOfOrphansBenefitingFromTheEidSuitSponsorship()),
            'params' => getParams(),
            'archive' => fn () => Archive::with('savedBy:id,first_name,last_name')->whereOccasion('eid_suit')
                ->whereMonth('created_at', now()->format('m-Y'))->select(['id', 'saved_by', 'created_at'])->first(),
        ]);
    }
}
