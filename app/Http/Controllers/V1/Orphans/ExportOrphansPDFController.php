<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Orphans\OrphansIndexRequest;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class ExportOrphansPDFController extends Controller
{
    /**
     * @throws CouldNotTakeBrowsershot
     * @throws Throwable
     */
    public function __invoke(OrphansIndexRequest $request): StreamedResponse
    {
        return saveToPDF('orphans', function () {
            return getOrphans();
        });
    }
}
