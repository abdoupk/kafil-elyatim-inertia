<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Inertia\Inertia;
use Inertia\Response;

class SponsorsStatisticsController extends Controller implements HasMiddleware
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/sponsors/statistics/SponsorsStatisticsPage', [
            'sponsorsBySponsorType' => getSponsorsBySponsorType(),
            'sponsorsByAcademicLevel' => getSponsorsByAcademicLevel(),
            'sponsorsBySponsorship' => getSponsorsBySponsorship(),
            'sponsorsByDiploma' => getSponsorsByDiploma(),
        ]);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
