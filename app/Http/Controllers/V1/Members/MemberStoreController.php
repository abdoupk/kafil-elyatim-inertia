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
        $user = User::create($request->only(['password', 'email', 'last_name', 'first_name', 'phone', 'zone_id', 'branch_id', 'qualification', 'gender']));

        $user->syncRoles($request->roles);

        $user->searchable();

        $user->roles()->searchable();

        return response('', 201);
    }
}
