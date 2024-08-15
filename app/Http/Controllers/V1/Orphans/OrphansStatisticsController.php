<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class OrphansStatisticsController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/orphans/statistics/OrphansStatisticsPage');
    }
}
