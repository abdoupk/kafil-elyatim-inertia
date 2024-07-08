<?php

namespace App\Http\Controllers\V1\Occasions\RamadanBasket;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportFamiliesRamadanBasketPDF extends Controller
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
