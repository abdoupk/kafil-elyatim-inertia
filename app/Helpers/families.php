<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Family;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

function getFamilies(): LengthAwarePaginator
{
    return search(Family::getModel())
        ->query(fn ($query) => $query->with('zone'))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}
