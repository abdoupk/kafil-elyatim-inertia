<?php

namespace App\Http\Controllers\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Inventory\ItemUpdateRequest;
use App\Models\Inventory;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class ItemUpdateController extends Controller
{
    public function __invoke(ItemUpdateRequest $request, Inventory $item): \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
    {
        $item->update($request->validated());

        return response('', 201);
    }
}
