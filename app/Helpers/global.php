<?php

/** @noinspection UnknownInspectionInspection */

/** @noinspection NullPointerExceptionInspection */

use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

function getFilters(): array
{
    return [
        /* @phpstan-ignore-next-line */
        'page' => (int) request()->input('page', 1),
        'search' => request()->input('search', ''),
        'perPage' => request()->input('perPage', 10),
        'fields' => request()->input('fields'),
        'directions' => request()->input('directions'),
    ];
}

/**
 * @throws Throwable
 * @throws CouldNotTakeBrowsershot
 */
function saveToPDF(string $directory, callable $function): StreamedResponse
{
    $disk = Storage::disk('public');

    if (! $disk->directoryExists($directory)) {
        $disk->makeDirectory($directory);
    }

    $pdfFile = "$directory/$directory-".now()->format('y-m-d').'.pdf';
    $pdfPath = $disk->path($pdfFile);

    Browsershot::html(view("pdf.$directory", [$directory => $function()])
        ->render())
        ->ignoreHttpsErrors()
        ->noSandbox()
        ->format('A4')
        ->landscape()
        ->save($pdfPath);

    return $disk->download($pdfFile);
}
