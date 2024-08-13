<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\BabyMilkAndDiapersResource;
use App\Models\Archive;
use Inertia\Inertia;

class BabyMilkAndDiapersIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/babies/BabyMilkAndDiapersIndex', [
            'orphans' => BabyMilkAndDiapersResource::collection(listOfBabies()),
            'params' => getParams(),
            'archive' => fn () => Archive::with('savedBy:id,first_name,last_name')->whereOccasion('baby_milk_and_diapers')
                ->whereMonth('created_at', now()->format('m-Y'))->select(['id', 'saved_by', 'created_at'])->first(),
        ]);
    }
}
