<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Branches\BranchCreateUpdateRequest;
use App\Jobs\V1\BranchCreatedJob;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BranchStoreController extends Controller
{
    public function __invoke(BranchCreateUpdateRequest $request): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        $branch = Branch::create($request->validated());

        dispatch(new BranchCreatedJob($branch, auth()->user()));

        ray(User::whereHas('settings')->first());

        return response('', 201);
    }
}
