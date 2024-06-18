<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamiliesIndexRequest;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Throwable;

class DownloadFamiliesController extends Controller
{
    /**
     * @throws CouldNotTakeBrowsershot
     * @throws Throwable
     */
    public function __invoke(FamiliesIndexRequest $request): void
    {
        Browsershot::html(view('pdf.families', [
            'families' => getFamilies(
                //@phpstan-ignore-next-line
                $request->input('search') ?? '',
                (array) $request->input('directions'),
                //@phpstan-ignore-next-line
                $request->input('perPage') ?? 10),
        ])->render())
            ->ignoreHttpsErrors()
            ->noSandbox()
            ->format('A4')
            ->save(public_path('families-'.now()->format('Y-m-d').'.pdf'));
    }
}
