<?php

namespace App\Http\Controllers\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Inventory\ItemUpdateRequest;
use App\Jobs\V1\Inventory\InventoryItemUpdatedJob;
use App\Models\Inventory;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;

class ItemUpdateController extends Controller implements HasMiddleware
{
    public function __invoke(ItemUpdateRequest $request, Inventory $item): \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
    {
        $item->update($request->validated());

        dispatch(new InventoryItemUpdatedJob($item, auth()->user()));

        return response('', 201);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
