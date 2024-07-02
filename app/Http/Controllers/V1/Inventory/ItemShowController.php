<?php

namespace App\Http\Controllers\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Inventory\ItemResource;
use App\Models\Inventory;

class ItemShowController extends Controller
{
    public function __invoke(Inventory $item)
    {
        return response()->json([
            'item' => ItemResource::make($item),
        ]);
    }
}
