<?php

namespace App\Http\Controllers\V1\Occasions\EidSuit;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportOrphansEidSuitPDF extends Controller
{
    /**
     * @throws \Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke(): StreamedResponse
    {
        return saveToPDF('occasions/eid-al-adha-families', 'families', function () {
            return listOfFamiliesBenefitingFromTheEidAlAdhaSponsorship();
        });
    }
}
