<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Branches\BranchCreateUpdateRequest;
use App\Models\Branch;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BranchStoreController extends Controller
{
    public function __invoke(BranchCreateUpdateRequest $request): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        Branch::create($request->validated());

        return response('', 201);
    }
}
