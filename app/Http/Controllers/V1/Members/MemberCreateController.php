<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Branches\BranchesResource;
use App\Http\Resources\V1\Roles\RoleResource;
use App\Http\Resources\V1\Zones\ZoneResource;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Zone;
use Inertia\Inertia;
use Inertia\Response;

class MemberCreateController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/members/MemberCreatePage',
            [
                'zones' => ZoneResource::collection(Zone::select(['id', 'name'])->get()),
                'branches' => BranchesResource::collection(Branch::select(['id', 'name'])->get()),
                'qualifications' => ['dd', '11', '1212'],
                'roles' => RoleResource::collection(Role::select(['uuid', 'name'])->get()),
            ]);
    }
}
