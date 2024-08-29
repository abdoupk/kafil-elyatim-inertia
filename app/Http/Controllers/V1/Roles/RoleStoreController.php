<?php

namespace App\Http\Controllers\V1\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Roles\RoleCreateRequest;
use App\Jobs\V1\Role\RoleCreatedJob;
use App\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;

class RoleStoreController extends Controller implements HasMiddleware
{
    public function __invoke(RoleCreateRequest $request)
    {
        $role = Role::create($request->only('name'));

        $permissions = array_keys(array_filter($request->permissions));

        $role->givePermissionTo($permissions);

        $role->searchable();

        dispatch(new RoleCreatedJob($role, auth()->user()));

        return response('', 201);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
