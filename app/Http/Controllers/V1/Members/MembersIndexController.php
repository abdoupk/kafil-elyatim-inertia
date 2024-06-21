<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Members\MembersIndexResource;
use Inertia\Inertia;
use Inertia\Response;

class MembersIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/members/index/MembersIndexPage', [
            'members' => MembersIndexResource::collection(getMembers()),
            'filters' => getFilters(),
        ]);
    }
}
