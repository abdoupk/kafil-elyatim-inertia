<?php

namespace App\Http\Controllers\V1\Archive\Exports;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class ExportArchiveFamiliesMonthlyBasketPDFController extends Controller
{
    /**
     * @throws Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke(Archive $archive): StreamedResponse
    {
        return saveArchiveToPDF('monthly-basket-families', function () {
            return listOfFamiliesBenefitingFromTheMonthlyBasketForExport();
        }, $archive->created_at->format('m-Y'));
    }
}
