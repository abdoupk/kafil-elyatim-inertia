<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/** @noinspection NullPointerExceptionInspection */
function getMembers(): LengthAwarePaginator
{
    /** @phpstan-ignore-next-line */
    $search = (string) request()->input('search', '');

    $directions = (array) request()->input('directions', []);

    /** @phpstan-ignore-next-line */
    $perPage = (int) request()->input('perPage', 10);

    $members = User::search($search);

    if ($directions) {
        foreach ($directions as $column => $direction) {
            $members->orderBy($column, $direction);
        }
    } else {
        $members->orderBy('created_at', 'desc');
    }

    return $members->query(fn (Builder $query) => $query->with(['zone']))
        ->where('tenant_id', auth()->user()?->tenant_id)
        ->paginate(perPage: $perPage);
}
