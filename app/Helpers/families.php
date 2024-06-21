<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Family;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/** @noinspection NullPointerExceptionInspection */
function getFamilies(): LengthAwarePaginator
{
    /** @phpstan-ignore-next-line */
    $search = (string) request()->input('search', '');

    $directions = (array) request()->input('directions', []);

    /** @phpstan-ignore-next-line */
    $perPage = (int) request()->input('perPage', 10);

    $families = Family::search($search);

    if ($directions) {
        foreach ($directions as $column => $direction) {
            $families->orderBy($column, $direction);
        }
    } else {
        $families->orderBy('created_at', 'desc');
    }

    if (! auth()->user()?->hasRole(['super_admin'])) {
        $families->where('zone_id', auth()->user()?->zone_id);
    }

    return $families->query(fn (Builder $query) => $query->with('zone'))
        ->where('tenant_id', auth()->user()?->tenant_id)
        ->paginate(perPage: $perPage);
}
