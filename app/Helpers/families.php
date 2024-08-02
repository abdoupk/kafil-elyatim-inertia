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

function getFamiliesForExport(): LengthAwarePaginator
{
    return search(Family::getModel())
        ->query(fn ($query) => $query->with(['zone:id,name', 'branch:id,name', 'sponsor.incomes', 'secondSponsor:id,income,family_id', 'orphans:id,income,family_id'])->withCount('orphans'))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}
