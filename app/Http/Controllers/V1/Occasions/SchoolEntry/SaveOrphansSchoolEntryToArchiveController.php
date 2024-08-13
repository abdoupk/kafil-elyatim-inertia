<?php

namespace App\Http\Controllers\V1\Occasions\SchoolEntry;

use App\Http\Controllers\Controller;
use App\Models\OrphanSponsorship;

class SaveOrphansSchoolEntryToArchiveController extends Controller
{
    public function __invoke()
    {
        listOfOrphansBenefitingFromTheSchoolEntrySponsorshipForExport()->flatMap(function (OrphanSponsorship $orphanSponsorship) {
            saveToArchive('school_entry', $orphanSponsorship);
        });
    }
}
