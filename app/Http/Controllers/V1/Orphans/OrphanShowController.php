<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Models\Orphan;
use Inertia\Inertia;
use Inertia\Response;

class OrphanShowController extends Controller
{
    public function __invoke(Orphan $orphan): Response
    {
        return Inertia::render('Tenant/orphans/OrphanDetailPage', [
            'orphan' => $orphan->load('sponsorships', 'academicAchievements'),
        ]);
    }
}
