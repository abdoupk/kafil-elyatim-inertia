<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Branches\BranchCreateUpdateRequest;
use App\Jobs\V1\Branch\BranchUpdatedJob;
use App\Models\Branch;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;

class BranchUpdateController extends Controller implements HasMiddleware
{
    public function __invoke(BranchCreateUpdateRequest $request, Branch $branch): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        $branch->update($request->validated());

        $branch->families->searchable();

        dispatch(new BranchUpdatedJob($branch, auth()->user()));

        return response('', 201);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
