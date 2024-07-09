<?php

use App\Models\Need;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

function getNeeds(): LengthAwarePaginator
{
    return search(Need::getModel())
        ->query(fn ($query) => $query
            ->with(['needable']))
        ->paginate(perPage: request()?->input('perPage', 10));
}
