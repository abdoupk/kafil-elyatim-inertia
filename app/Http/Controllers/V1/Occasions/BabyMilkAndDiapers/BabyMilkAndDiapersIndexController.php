<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\BabyMilkAndDiapersResource;
use App\Models\Archive;
use Illuminate\Routing\Controllers\HasMiddleware;
use Inertia\Inertia;

class BabyMilkAndDiapersIndexController extends Controller implements HasMiddleware
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/babies/BabyMilkAndDiapersIndex', [
            'orphans' => BabyMilkAndDiapersResource::collection(listOfBabies()),
            'params' => getParams(),
            'archive' => fn () => Archive::with('savedBy:id,first_name,last_name')->whereOccasion('babies_milk_and_diapers')
                ->whereMonth('created_at', now()->month)->select(['id', 'saved_by', 'created_at'])->first(),
        ]);
    }

    public static function middleware()
    {
        return ['can:view_occasions'];
    }
}
