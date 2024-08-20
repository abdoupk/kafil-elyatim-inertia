<?php

namespace App\Http\Controllers\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Inventory\InventoryItemTrashedJob;
use App\Models\Inventory;

class ItemDeleteController extends Controller
{
    public function __invoke(Inventory $item)
    {
        $item->delete();

        dispatch(new InventoryItemTrashedJob($item, auth()->user()));

        return redirect()->back();
    }
}
