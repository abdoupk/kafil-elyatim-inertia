<?php

namespace App\Http\Controllers\V1\Statistics;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class StatisticsIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/statistics/StatisticsIndexPage');
    }
}
