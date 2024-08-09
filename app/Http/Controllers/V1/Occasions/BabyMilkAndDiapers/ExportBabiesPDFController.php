<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Orphans\OrphansIndexRequest;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportBabiesPDFController extends Controller
{
    /**
     * @throws CouldNotTakeBrowsershot
     * @throws \Throwable
     */
    public function __invoke(OrphansIndexRequest $request): StreamedResponse
    {
        return saveToPDF('occasions/babies-milk-and-diapers', 'babies', function () {
            return getBabiesForExport();
        });
    }
}
