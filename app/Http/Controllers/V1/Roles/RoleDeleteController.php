<?php

namespace App\Http\Controllers\V1\Roles;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Role\RoleTrashedJob;
use App\Models\Role;

class RoleDeleteController extends Controller
{
    public function __invoke(Role $role)
    {
        $role->delete();

        dispatch(new RoleTrashedJob($role, auth()->user()));

        return redirect()->back();
    }
}
