<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class SponsorsIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/sponsors/index/SponsorsIndexPage', [
            'sponsors' => '',
            'params' => getParams(),
        ]);
    }
}
