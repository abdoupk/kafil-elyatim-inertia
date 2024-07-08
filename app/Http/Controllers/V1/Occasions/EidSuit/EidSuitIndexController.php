<?php

namespace App\Http\Controllers\V1\Occasions\EidSuit;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\EidSuitResource;
use Inertia\Inertia;

class EidSuitIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/eid-suit/EidSuitIndex', [
            'orphans' => EidSuitResource::collection(listOfOrphansBenefitingFromTheEidSuitSponsorship()),
            'params' => getParams(),
        ]);
    }
}
