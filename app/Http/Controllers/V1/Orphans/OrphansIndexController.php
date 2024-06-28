<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class OrphansIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/orphans/OrphansIndexPage');
    }
}
