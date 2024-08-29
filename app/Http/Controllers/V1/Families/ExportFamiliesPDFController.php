<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamiliesIndexRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class ExportFamiliesPDFController extends Controller implements HasMiddleware
{
    /**
     * @throws CouldNotTakeBrowsershot
     * @throws Throwable
     */
    public function __invoke(FamiliesIndexRequest $request): StreamedResponse
    {
        return saveToPDF('families', 'families', function () {
            return getFamiliesForExport();
        });
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
