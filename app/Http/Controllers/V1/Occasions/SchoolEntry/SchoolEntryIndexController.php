<?php

namespace App\Http\Controllers\V1\Occasions\SchoolEntry;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\SchoolEntryResource;
use Inertia\Inertia;

class SchoolEntryIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/school-entry/SchoolEntryIndex', [
            'orphans' => SchoolEntryResource::collection(listOfOrphansBenefitingFromTheSchoolEntrySponsorship()),
            'params' => getParams(),
        ]);
    }
}
