<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Inventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

function getInventoryItems(): LengthAwarePaginator
{
    return search(Inventory::getModel())
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}
