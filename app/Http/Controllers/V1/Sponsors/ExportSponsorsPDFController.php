<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Sponsors\SponsorsIndexRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class ExportSponsorsPDFController extends Controller implements HasMiddleware
{
    /**
     * @throws Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke(SponsorsIndexRequest $request): StreamedResponse
    {
        return saveToPDF('sponsors', 'sponsors', function () {
            return getSponsorsForExport();
        });
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
