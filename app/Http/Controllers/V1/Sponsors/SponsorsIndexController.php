<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use Inertia\Response;

class SponsorsIndexController extends Controller
{
    public function __invoke(): Response
    {
        return inertia()->render('Tenant/sponsors/SponsorsIndexPage');
    }
}
