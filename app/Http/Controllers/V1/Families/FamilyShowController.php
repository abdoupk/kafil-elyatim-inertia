<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Inertia\Inertia;
use Inertia\Response;

class FamilyShowController extends Controller
{
    public function __invoke(Family $family): Response
    {
        return Inertia::render('Tenant/families/FamilyDetailPage', [
            'family' => $family->load(['zone', 'orphans', 'furnishings', 'secondSponsor', 'furnishings', 'sponsorships']),
        ]);
    }
}
