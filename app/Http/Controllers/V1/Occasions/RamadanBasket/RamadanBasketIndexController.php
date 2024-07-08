<?php

namespace App\Http\Controllers\V1\Occasions\RamadanBasket;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\RamadanBasketResource;
use Inertia\Inertia;
use Inertia\Response;

class RamadanBasketIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/occasions/ramadan-basket/RamadanBasketIndex', [
            'families' => RamadanBasketResource::collection(listOfFamiliesBenefitingFromTheEidAlAdhaSponsorship()),
            'params' => getParams(),
        ]);
    }
}
