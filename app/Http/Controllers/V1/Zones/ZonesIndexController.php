<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ZonesIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/zones/ZonesIndexPage');
    }
}
