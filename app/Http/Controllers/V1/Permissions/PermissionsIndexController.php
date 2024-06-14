<?php

namespace App\Http\Controllers\V1\Permissions;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class PermissionsIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/permissions/PermissionsIndexPage');
    }
}
