<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class BranchesIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/branches/BranchesIndexPage');
    }
}
