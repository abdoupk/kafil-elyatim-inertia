<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/** @noinspection NullPointerExceptionInspection */
function getMembers(): LengthAwarePaginator
{
    return search(User::getModel())
        ->query(fn ($query) => $query->with('zone'))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}
