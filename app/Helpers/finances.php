<?php

use App\Models\Finance;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

function getFinances(): LengthAwarePaginator
{
    return search(Finance::getModel())
        ->query(fn (Builder $query) => $query->with('creator'))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()->input('perPage', 10));
}
