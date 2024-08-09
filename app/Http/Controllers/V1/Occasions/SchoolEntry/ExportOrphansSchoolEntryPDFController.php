<?php

namespace App\Http\Controllers\V1\Occasions\SchoolEntry;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportOrphansSchoolEntryPDFController extends Controller
{
    /**
     * @throws \Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke(): StreamedResponse
    {
        return saveToPDF('occasions/school-entry', 'sponsorships', function () {
            return listOfOrphansBenefitingFromTheSchoolEntrySponsorshipForExport();
        });
    }
}
