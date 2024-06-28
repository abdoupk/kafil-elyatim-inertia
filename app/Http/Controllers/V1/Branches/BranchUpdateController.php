<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Branches\BranchCreateUpdateRequest;
use App\Models\Branch;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BranchUpdateController extends Controller
{
    public function __invoke(BranchCreateUpdateRequest $request, Branch $branch): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        $branch->update($request->validated());

        return response('', 201);
    }
}
