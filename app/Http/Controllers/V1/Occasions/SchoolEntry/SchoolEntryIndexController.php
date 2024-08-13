<?php

namespace App\Http\Controllers\V1\Occasions\SchoolEntry;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\SchoolEntryResource;
use App\Models\Archive;
use Inertia\Inertia;

class SchoolEntryIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/occasions/school-entry/SchoolEntryIndex', [
            'orphans' => SchoolEntryResource::collection(listOfOrphansBenefitingFromTheSchoolEntrySponsorship()),
            'params' => getParams(),
            'archive' => fn () => Archive::with('savedBy:id,first_name,last_name')->whereOccasion('school_entry')
                ->whereMonth('created_at', now()->format('m-Y'))->select(['id', 'saved_by', 'created_at'])->first(),
        ]);
    }
}
