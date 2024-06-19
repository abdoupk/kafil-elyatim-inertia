<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamiliesIndexRequest;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class ExportFamiliesPDFController extends Controller
{
    /**
     * @throws Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke(FamiliesIndexRequest $request): BinaryFileResponse
    {
        saveFamiliesToPDF(
            /* @phpstan-ignore-next-line */
            (string) $request->input('search', ''),
            (array) $request->input('directions', []),
            /* @phpstan-ignore-next-line */
            (int) $request->input('perPage', 10),
        );

        return response()->download(Storage::disk('public')->path('families/families-'.now()->format('y-m-d').'.pdf'));
    }
}
