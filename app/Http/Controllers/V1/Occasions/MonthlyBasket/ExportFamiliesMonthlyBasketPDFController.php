<?php

namespace App\Http\Controllers\V1\Occasions\MonthlyBasket;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportFamiliesMonthlyBasketPDFController extends Controller
{
    /**
     * @throws \Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke(): StreamedResponse
    {
        return saveToPDF('occasions/monthly-basket', 'sponsorships', function () {
            return listOfFamiliesBenefitingFromTheMonthlyBasketForExport();
        });
    }
}
