<?php

namespace App\Http\Controllers\V1\Occasions\SchoolEntry;

use App\Http\Controllers\Controller;

class SaveOrphansSchoolEntryToArchiveController extends Controller
{
    public function __invoke()
    {
        saveToArchive('school_entry', function () {
            return listOfOrphansBenefitingFromTheSchoolEntrySponsorshipForExport();
        });
    }
}
