<?php

use App\Models\Family;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;

function getFamilies(): LengthAwarePaginator
{
    $search = request()?->input('search', '');

    $directions = request()?->input('directions', []);

    $perPage = request()?->input('perPage', 10);

    $families = Family::search($search);

    if ($directions) {
        foreach ($directions as $column => $direction) {
            $families->orderBy($column, $direction);
        }
    } else {
        $families->orderBy('created_at', 'desc');
    }

    if (! auth()->user()?->hasRole(['president', 'vice_president'])) {
        $families->where('zone_id', auth()->user()?->zone_id);
    }

    return $families->query(fn (Builder $query) => $query->with('zone'))
        ->where('tenant_id', auth()->user()?->tenant_id)
        ->paginate(perPage: $perPage);
}

/**
 * @throws Throwable
 * @throws CouldNotTakeBrowsershot
 */
function saveFamiliesToPDF(string $search, array $directions = [], int $perPage = 10): void
{
    if (! Storage::disk('public')->directoryExists('families')) {
        Storage::disk('public')->makeDirectory('families');
    }

    Browsershot::html(view('pdf.families', [
        'families' => getFamilies(),
    ])->render())
        ->ignoreHttpsErrors()
        ->noSandbox()
        ->format('A4')
        ->save(Storage::disk('public')->path('families/families-'.now()->format('y-m-d').'.pdf'));
}
