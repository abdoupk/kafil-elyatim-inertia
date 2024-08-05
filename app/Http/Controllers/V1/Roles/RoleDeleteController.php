<?php

namespace App\Http\Controllers\V1\Roles;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleDeleteController extends Controller
{
    public function __invoke(Role $role)
    {
        $role->delete();

        return redirect()->back();
    }
}
