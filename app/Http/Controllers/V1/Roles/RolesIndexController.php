<?php

namespace App\Http\Controllers\V1\Roles;

use App\Http\Controllers\Controller;
use Inertia\Response;

class RolesIndexController extends Controller
{
    public function __invoke(): Response
    {
        return inertia()->render('Tenant/roles/RolesIndexPage');
    }
}
