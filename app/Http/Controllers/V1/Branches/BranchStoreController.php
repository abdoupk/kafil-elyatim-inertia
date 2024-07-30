<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Branches\BranchCreateUpdateRequest;
use App\Models\Branch;
use App\Notifications\CreateBranchNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BranchStoreController extends Controller
{
    public function __invoke(BranchCreateUpdateRequest $request): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        $branch = Branch::create($request->validated());

        auth()->user()->notifyNow(new CreateBranchNotification($branch));

        return response('', 201);
    }
}
