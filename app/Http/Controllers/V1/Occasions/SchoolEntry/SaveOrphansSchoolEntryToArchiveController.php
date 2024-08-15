<?php

namespace App\Http\Controllers\V1\Occasions\SchoolEntry;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\OrphanSponsorship;

class SaveOrphansSchoolEntryToArchiveController extends Controller
{
    public function __invoke()
    {
        Archive::where('occasion', '=', 'school_entry')
            ->whereYear('created_at', '=', now()->year)->firstOrCreate([
                'occasion' => 'school_entry',
                'saved_by' => auth()->user()->id,
            ])
            ->orphans()
            ->syncWithPivotValues(listOfOrphansBenefitingFromTheSchoolEntrySponsorshipForExport()->map(function (OrphanSponsorship $sponsorship) {
                return $sponsorship->orphan->id;
            }), ['tenant_id' => tenant('id')]);
    }
}
