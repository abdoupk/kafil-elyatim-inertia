<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Branches\BranchesIndexResource;
use App\Http\Resources\V1\Members\MemberResource;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class BranchesIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/branches/BranchesIndexPage', [
            'branches' => BranchesIndexResource::collection(getBranches()),
            'params' => getParams(),
            'members' => MemberResource::collection(User::select(['id', 'first_name', 'last_name'])->get()),
        ]);
    }
}
