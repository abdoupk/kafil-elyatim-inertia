<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Members\MemberCreateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MemberStoreController extends Controller
{
    public function __invoke(MemberCreateRequest $request): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        User::create($request->validated());

        return response('', 201);
    }
}
