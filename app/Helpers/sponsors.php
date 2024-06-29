<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Sponsor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

function getSponsors(): LengthAwarePaginator
{
    return search(Sponsor::getModel())
        ->query(fn ($query) => $query->with('zone'))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}
