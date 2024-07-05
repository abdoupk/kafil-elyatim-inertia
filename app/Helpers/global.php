<?php

/** @noinspection UnknownInspectionInspection */

/** @noinspection NullPointerExceptionInspection */

use App\Models\Branch;
use App\Models\Family;
use App\Models\Inventory;
use App\Models\Orphan;
use App\Models\Role;
use App\Models\Sponsor;
use App\Models\User;
use App\Models\Zone;
use Laravel\Scout\Builder;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
            return [$condition['field'], $condition['operator'], $condition['value']];
        }, $filters);
    }

    return [];
}

function generateFilterConditions(?array $_filters = []): string
{
    $filters = array_merge($_filters, generateFormatedConditions());

    if (! $filters) {
        return 'tenant_id = '.tenant('id');
    }

    return implode(' AND ', array_map(static function ($condition) {
        return implode(' ', $condition);
    }, $filters)).' AND tenant_id = '.tenant('id');
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

function search(Inventory|User|Family|Branch|Orphan|Sponsor|Role|Zone $model, ?array $filters = []): Builder
{
    $query = request()->input('search', '');
    $meilisearchOptions = [
        'filter' => generateFilterConditions($filters),
        'sort' => generateFormattedSort(),
    ];

    // @phpstan-ignore-next-line
    return $model::search($query, static function ($meilisearch, string $query, array $options) use ($meilisearchOptions) {
        return $meilisearch->search($query, $options + $meilisearchOptions);
    });
}
