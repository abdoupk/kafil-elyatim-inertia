<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

function getRoles(): LengthAwarePaginator
{
    return search(Role::getModel())
        ->query(fn ($query) => $query->withCount(['users', 'permissions']))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}
