<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Branches\BranchesResource;
use App\Http\Resources\V1\Members\MembersResource;
use App\Http\Resources\V1\ZoneResource;
use App\Models\Branch;
use App\Models\User;
use App\Models\Zone;
use Inertia\Inertia;
use Inertia\Response;

class FamilyCreateController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/families/create/FamilyCreatePage', [
            'zones' => ZoneResource::collection(Zone::select(['id', 'name'])->get()),
            'members' => MembersResource::collection(User::select(['id', 'first_name', 'last_name'])->get()),
            'branches' => BranchesResource::collection(Branch::select(['id', 'name'])->get()),
        ]);
    }
}
