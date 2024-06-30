<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Orphan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

function getOrphans(): LengthAwarePaginator
{
    return search(Orphan::getModel())
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}
