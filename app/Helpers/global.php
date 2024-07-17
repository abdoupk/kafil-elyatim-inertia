<?php

/** @noinspection UnknownInspectionInspection */

/** @noinspection NullPointerExceptionInspection */

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Builder;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @throws Throwable
 * @throws CouldNotTakeBrowsershot
 */
function saveToPDF(string $directory, string $variableName, callable $function): StreamedResponse
{
    $disk = Storage::disk('public');

    if (! $disk->directoryExists($directory)) {
        $disk->makeDirectory($directory);
    }

    $pdfFile = "$directory/$directory-".now()->format('y-m-d').'.pdf';
    $pdfPath = $disk->path($pdfFile);

    Browsershot::html(view("pdf.$directory", [$variableName => $function()])
        ->render())
        ->ignoreHttpsErrors()
        ->noSandbox()
        ->format('A4')
        ->landscape()
        ->save($pdfPath);

    return $disk->download($pdfFile);
}

function getParams(): array
{
    return [
        /* @phpstan-ignore-next-line */
        'page' => (int) request()->input('page', 1),
        'search' => request()->input('search', ''),
        'perPage' => request()->input('perPage', 10),
        'fields' => request()->input('fields'),
        'directions' => request()->input('directions'),
        'filters' => request()->input('filters'),
    ];
}

function generateFormatedConditions(): array
{
    $filters = (array) request()->input('filters', []);

    if ($filters) {
        /** @phpstan-ignore-next-line */
        return array_map(static function (array $condition) {

            return [$condition['field'], $condition['operator'],  (str_contains($condition['value'], ' ')) ? '"'.$condition['value'].'"' : $condition['value']];
        }, $filters);
    }

    return [];
}

function generateFilterConditions(?string $additional_filters = ''): string
{
    $filters = array_merge(generateFormatedConditions());

    if (! $filters) {
        return 'tenant_id = '.tenant('id').' '.$additional_filters;
    }

    return implode(' AND ', array_map(static function ($condition) {
        return implode(' ', $condition);
    }, $filters)).' AND tenant_id = '.tenant('id').' '.$additional_filters;
}

function generateFormattedSort(): array
{
    $directions = (array) request()->input('directions', []);

    if ($directions) {
        /** @phpstan-ignore-next-line */
        return array_map(static function (string $value, string $key) {
            return "$key:$value";
        }, array_values($directions), array_keys($directions));
    }

    return ['created_at:desc'];
}

function search(Model $model, ?string $additional_filters = ''): Builder
{
    $query = trim(request()->input('search', '')) ?? '';
    $meilisearchOptions = [
        'filter' => generateFilterConditions($additional_filters),
        'sort' => generateFormattedSort(),
    ];

    return $model::search($query, static function ($meilisearch, string $query, array $options) use ($meilisearchOptions) {
        return $meilisearch->search($query, $options + $meilisearchOptions);
    });
}
