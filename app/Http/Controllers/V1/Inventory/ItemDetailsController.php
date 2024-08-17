<?php

namespace App\Http\Controllers\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Inventory\ItemShowResource;
use App\Models\Inventory;

class ItemDetailsController extends Controller
{
    public function __invoke(Inventory $item)
    {
        return response()->json([
            'item' => ItemShowResource::make($item->load(['city', 'president:id,last_name,first_name', 'creator:id,first_name,last_name'])->loadCount('families')),
        ]);
    }
}
