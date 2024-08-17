<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Members\MemberShowResource;
use App\Models\User;

class MemberDetailsController extends Controller
{
    public function __invoke(User $member)
    {
        return response()->json([
            'member' => MemberShowResource::make($member->load(['city', 'president:id,last_name,first_name', 'creator:id,first_name,last_name'])->loadCount('families')),
        ]);
    }
}
