<?php

namespace App\Http\Controllers\V1\Roles;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class RolesIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/roles/RolesIndexPage');
    }
}
