<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Zone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/** @noinspection NullPointerExceptionInspection */
function getZones(): LengthAwarePaginator
{
    /** @phpstan-ignore-next-line */
    $search = (string) request()->input('search', '');

    $directions = (array) request()->input('directions', []);

    /** @phpstan-ignore-next-line */
    $perPage = (int) request()->integer('perPage', 10);

    $zones = Zone::search($search);

    if ($directions) {
        foreach ($directions as $column => $direction) {
            $zones->orderBy($column, $direction);
        }
    } else {
        $zones->orderBy('created_at', 'desc');
    }

    return $zones->where('tenant_id', auth()->user()?->tenant_id)
        ->paginate(perPage: $perPage);
}
