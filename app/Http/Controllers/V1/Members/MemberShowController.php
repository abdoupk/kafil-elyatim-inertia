<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Members\MemberUpdateResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class MemberShowController extends Controller
{
    public function __invoke(User $member): JsonResponse
    {
        return response()->json([
            'member' => MemberUpdateResource::make($member->load(['zone', 'branch', 'roles.permissions'])),
        ]);
    }
}
