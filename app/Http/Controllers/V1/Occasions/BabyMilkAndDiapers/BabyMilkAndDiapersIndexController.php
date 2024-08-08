<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\BabyMilkAndDiapersResource;
use Inertia\Inertia;

class BabyMilkAndDiapersIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/babies/BabyMilkAndDiapersIndex', [
            'orphans' => BabyMilkAndDiapersResource::collection(listOfOrphansBenefitingFromTheEidSuitSponsorship()),
            'params' => getParams(),
        ]);
    }
}
