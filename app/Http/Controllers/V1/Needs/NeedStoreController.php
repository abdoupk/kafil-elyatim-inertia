<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Needs\NeedCreateRequest;
use App\Models\Need;

class NeedStoreController extends Controller
{
    public function __invoke(NeedCreateRequest $request)
    {
        Need::create($request->validated());

        return response('', 201);
    }
}
