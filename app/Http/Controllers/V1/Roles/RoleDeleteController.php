<?php

namespace App\Http\Controllers\V1\Roles;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Role\RoleTrashedJob;
use App\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;

class RoleDeleteController extends Controller implements HasMiddleware
{
    public function __invoke(Role $role)
    {
        $role->delete();

        dispatch(new RoleTrashedJob($role, auth()->user()));

        return redirect()->back();
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
