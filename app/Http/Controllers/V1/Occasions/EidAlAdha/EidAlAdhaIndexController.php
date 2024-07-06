<?php

namespace App\Http\Controllers\V1\Occasions\EidAlAdha;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\EidAlAdhaResource;
use Inertia\Inertia;

class EidAlAdhaIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/eid-al-adha/eidAlAdhaIndex', [
            'families' => EidAlAdhaResource::collection(listOfFamiliesBenefitingFromTheEidAlAdhaSponsorship()),
            'params' => getParams(),
        ]);
    }
}
