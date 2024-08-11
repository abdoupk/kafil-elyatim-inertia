<?php

/** @noinspection UnknownInspectionInspection */

/** @noinspection NullPointerExceptionInspection */

use App\Models\Archive;
use App\Models\FamilySponsorship;
use App\Models\VocationalTraining;
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

    $pdfName = __('exports.'.Str::replace('-', '_', explode('/', "$directory/$variableName")[1]));

    $pdfFile = "$directory/$pdfName".'_'.now()->format('y-m-d').'.pdf';

    $pdfPath = $disk->path($pdfFile);

    Browsershot::html(view("pdf.$directory", [$variableName => $function()])
        ->render())
        ->ignoreHttpsErrors()
        ->noSandbox()
        ->format('A4')
        ->margins(2, 4, 2, 4)
        ->landscape()
        ->save($pdfPath);

    // TODO add Footer name of auth and date
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
            ray($condition);

            return [$condition['field'], $condition['operator'], (str_contains($condition['value'], ' ')) ? '"'.$condition['value'].'"' : $condition['value']];
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
            if ($key === 'orphan.birth_date') {
                return $value === 'desc' ? "$key:asc" : "$key:desc";
            }

            return "$key:$value";
        }, array_values($directions), array_keys($directions));
    }

    return ['created_at:desc'];
}

function search(Model $model, ?string $additional_filters = '', ?int $limit = null): Builder
{
    if (! $limit) {
        $limit = (int) request()->input('perPage', 10);
    }

    $query = trim(request()->input('search', '')) ?? '';

    $meilisearchOptions = [
        'filter' => generateFilterConditions($additional_filters),
        'sort' => generateFormattedSort(),
        'limit' => $limit,
    ];

    if (property_exists($model, 'deleted_at')) {
        $meilisearchOptions['filter'] .= ' AND __soft_deleted = 0';
    }

    return $model::search($query, static function ($meilisearch, string $query, array $options) use ($meilisearchOptions) {
        unset($options['filter']);

        return $meilisearch->search($query, $options + $meilisearchOptions);
    });
}

function formatedVocationalTrainingSpecialities(): array
{
    $formattedArray = [];

    $rows = VocationalTraining::get();

    foreach ($rows as $row) {
        $formattedArray[$row['division']]['division'] = $row['division'];

        $formattedArray[$row['division']]['specialities'][] = ['name' => $row['speciality'], 'id' => $row['id']];
    }

    return array_values($formattedArray);
}

const DEFAULT_NOTIFICATIONS = [
    'branch' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'zone' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'orphan' => [
        'deleted' => true,
        'updated' => true,
    ],
    'sponsor' => [
        'deleted' => true,
        'updated' => true,
    ],
    'family' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'school' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'lesson' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'member' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'need' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
];

function formatCurrency(float $amount): false|string
{
    $formatter = new NumberFormatter(app()->getLocale().'_DZ', NumberFormatter::CURRENCY);

    return $formatter->formatCurrency($amount, 'DZD');
}

function calculateAge($birthDate): string
{
    $diff = date_diff($birthDate, now());
    $dates = [];

    if ($diff->y > 0) {
        $dates[] = trans_choice('age_years', $diff->y, ['value' => $diff->y]);
    }

    if ($diff->m > 0) {
        $dates[] = trans_choice('age_months', $diff->m, ['value' => $diff->m]);
    }

    if ($diff->d > 0) {
        $dates[] = trans_choice('age_days', $diff->d, ['value' => $diff->d]);
    }

    return implode(trans('finale_glue'), $dates);
}

function formatPhoneNumber($phone): string
{
    return substr($phone, 0, 4).'-'.
        substr($phone, 4, 2).'-'.
        substr($phone, 6, 2).'-'.
        substr($phone, 8, 2);
}

function saveToArchive(?string $additional_filters): void
{
    $data = search(FamilySponsorship::getModel(), $additional_filters)->get();

    $familyIds = $data->flatMap(function ($familySponsorShip) {
        return $familySponsorShip->family()->pluck('id')->toArray();
    });

    $formatted_data = [
        'family_ids' => $familyIds,
        'families_count' => count($familyIds),
        'saved_month' => now()->format('m-Y'),
        'occasion' => request()->input('occasion'),
        'saved_by' => auth()->user()->id,
    ];

    Archive::updateOrCreate([
        'saved_month' => $formatted_data['saved_month'],
    ], $formatted_data);
}
