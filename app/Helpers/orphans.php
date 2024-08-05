<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Orphan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

function getOrphans(): LengthAwarePaginator
{
    return search(Orphan::getModel())
        ->query(fn ($query) => $query->with('academicLevel'))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function searchOrphans(): Collection
{
    return search(Orphan::getModel())->get();
}
