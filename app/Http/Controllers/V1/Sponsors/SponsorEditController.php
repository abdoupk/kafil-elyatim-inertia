<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Sponsors\SponsorEditResource;
use App\Models\Sponsor;
use Inertia\Inertia;

class SponsorEditController extends Controller
{
    public function __invoke(Sponsor $sponsor)
    {
        return Inertia::render('Tenant/sponsors/edit/SponsorEditPage', [
            'sponsor' => new SponsorEditResource($sponsor->load('creator', 'sponsorships', 'incomes', 'academicLevel')),
        ]);
    }
}
