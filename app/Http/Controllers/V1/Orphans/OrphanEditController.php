<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Orphans\OrphanEditResource;
use App\Models\Orphan;
use Inertia\Inertia;
use Inertia\Response;

class OrphanEditController extends Controller
{
    public function __invoke(Orphan $orphan): Response
    {
        return Inertia::render('Tenant/orphans/edit/OrphanEditPage', [
            'orphan' => new OrphanEditResource($orphan->load('babyNeeds', 'academicAchievements', 'sponsorships', 'creator')),
        ]);
    }
}
