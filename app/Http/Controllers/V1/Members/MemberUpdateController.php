<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Members\MemberUpdateRequest;
use App\Jobs\V1\Member\MemberUpdatedJob;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MemberUpdateController extends Controller
{
    public function __invoke(MemberUpdateRequest $request, User $member): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        $member->update($request->except(['roles', 'formatted_roles', 'zone', 'branch', 'id']));

        $member->syncRoles($request->roles);

        dispatch(new MemberUpdatedJob($member, auth()->user()));

        return response('', 201);
    }
}
