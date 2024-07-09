<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Sponsors\SponsorShowResource;
use App\Models\Sponsor;
use Inertia\Inertia;
use Inertia\Response;

class SponsorShowController extends Controller
{
    public function __invoke(Sponsor $sponsor): Response
    {
        return Inertia::render('Tenant/sponsors/details/SponsorDetailPage', [
            'sponsor' => new SponsorShowResource($sponsor->load('sponsorships', 'family.zone', 'family.branch', 'incomes', 'creator')->loadCount('orphans')),
        ]);
    }
}
