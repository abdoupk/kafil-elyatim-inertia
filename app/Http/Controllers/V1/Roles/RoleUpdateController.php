<?php

namespace App\Http\Controllers\V1\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Roles\RoleUpdateRequest;
use App\Jobs\V1\Role\RoleUpdatedJob;
use App\Models\Role;

class RoleUpdateController extends Controller
{
    public function __invoke(Role $role, RoleUpdateRequest $request)
    {
        $role->update($request->only('name'));

        $permissions = array_keys(array_filter($request->permissions));

        $role->syncPermissions($permissions);

        $role->searchable();

        dispatch(new RoleUpdatedJob($role, auth()->user()));

        return response('', 201);
    }
}
