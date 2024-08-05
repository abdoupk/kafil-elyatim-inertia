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

function getSponsorsForExport(): Collection
{
    return search(Sponsor::getModel(), limit: 10000)
        ->query(fn ($query) => $query->with(['academicLevel', 'incomes:id,sponsor_id,total_income'])->withCount('orphans'))->get();
}
