<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamiliesIndexRequest;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class ExportFamiliesPDFController extends Controller
{
    /**
     * @throws CouldNotTakeBrowsershot
     * @throws Throwable
     */
    public function __invoke(FamiliesIndexRequest $request): StreamedResponse
    {
        return saveToPDF('families', 'families', function () {
            return getFamilies();
        });
    }
}
