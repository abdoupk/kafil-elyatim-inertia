<?php

namespace App\Http\Controllers\V1\Occasions\SchoolEntry;

use App\Http\Controllers\Controller;
use App\Models\Archive;

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
            ->syncWithPivotValues(listOfOrphansBenefitingFromTheSchoolEntrySponsorshipForExport()->pluck('id'), ['tenant_id' => tenant('id')]);
    }
}
