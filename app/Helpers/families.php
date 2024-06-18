<?php

use App\Models\Family;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

function getFamilies(string $search, ?array $directions, int $perPage): LengthAwarePaginator
{
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
