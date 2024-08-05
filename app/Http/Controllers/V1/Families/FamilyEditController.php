<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Families\FamilyShowResource;
use App\Models\Family;
use Inertia\Inertia;
use Inertia\Response;

class FamilyEditController extends Controller
{
    public function __invoke(Family $family): Response
    {
        return Inertia::render('Tenant/families/edit/FamilyEditPage', [
            'family' => FamilyShowResource::make($family->load(['furnishings', 'housing', 'sponsor.incomes', 'sponsor.creator', 'secondSponsor', 'sponsorships', 'preview.inspectors', 'deceased'])),
        ]);
    }
}
