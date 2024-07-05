<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Families\FamilyShowResource;
use App\Models\Family;
use Inertia\Inertia;
use Inertia\Response;

class FamilyShowController extends Controller
{
    public function __invoke(Family $family): Response
    {
        ray(FamilyShowResource::make($family->load(['zone', 'orphans', 'furnishings', 'housing', 'secondSponsor', 'furnishings', 'sponsorships', 'orphansSponsorships', 'sponsorSponsorships', 'preview', 'deceased'])));

        return Inertia::render('Tenant/families/details/FamilyDetailPage', [
            'family' => FamilyShowResource::make($family->load(['zone', 'orphans', 'furnishings', 'housing', 'sponsor.incomes', 'secondSponsor', 'furnishings', 'sponsorships', 'orphansSponsorships', 'sponsorSponsorships', 'preview', 'deceased'])),
        ]);
    }
}
