<?php

namespace App\Http\Controllers\V1\Archive\Exports;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class ExportArchiveFamiliesEidAlAdhaPDFController extends Controller
{
    /**
     * @throws Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke(Archive $archive): StreamedResponse
    {
        return saveArchiveToPDF('eid-al-adha-families', function () {
            return listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport();
        }, $archive->created_at->year);
    }
}
