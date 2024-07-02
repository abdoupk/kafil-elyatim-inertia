<?php

namespace App\Http\Controllers\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Inventory\ItemCreateRequest;
use App\Models\Inventory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ItemStoreController extends Controller
{
    public function __invoke(ItemCreateRequest $request): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        Inventory::create($request->validated());

        return response('', 201);
    }
}
