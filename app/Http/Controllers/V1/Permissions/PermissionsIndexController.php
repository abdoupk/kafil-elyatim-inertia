<?php

namespace App\Http\Controllers\V1\Permissions;

use App\Http\Controllers\Controller;
use Inertia\Response;

class PermissionsIndexController extends Controller
{
    public function __invoke(): Response
    {
        return inertia()->render('Tenant/permissions/PermissionsIndexPage');
    }
}
