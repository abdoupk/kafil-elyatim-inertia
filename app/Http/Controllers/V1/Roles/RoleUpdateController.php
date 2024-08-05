<?php

namespace App\Http\Controllers\V1\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Roles\RoleUpdateRequest;
use App\Models\Role;

class RoleUpdateController extends Controller
{
    public function __invoke(Role $role, RoleUpdateRequest $request)
    {
        $role->update($request->only('name'));

        $permissions = array_keys(array_filter($request->permissions));

        $role->syncPermissions($permissions);

        $role->searchable();

        return response('', 201);
    }
}
