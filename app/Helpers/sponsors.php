<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Sponsor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

function getSponsors(): LengthAwarePaginator
{
    return search(Sponsor::getModel())
        ->query(fn ($query) => $query->with('academicLevel'))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function searchSponsors(): Collection
{
    return search(Sponsor::getModel())->get();
}
