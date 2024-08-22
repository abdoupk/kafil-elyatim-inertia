<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class OrphansStatisticsController extends Controller
{
    public function __invoke(): Response
    {
        ray(getOrphansByFamilyStatus());
        ray(getOrphansByAcademicLevel());
        ray(getOrphansBySponsorship());
        ray(getOrphansByGender());
        ray(getOrphansByAge());
        ray(getOrphansByZone());
        ray(getOrphansByBranch());
        ray(getByPantsAndShirtSize());
        ray(getOrphansByShoeSize());
        ray(getOrphansByVocationalTraining());
        ray(getOrphansGroupByCreatedDate());
        ray(getOrphansGroupHealthStatus());

        return Inertia::render('Tenant/orphans/statistics/OrphansStatisticsPage', [
            'orphansByFamilyStatus' => getOrphansByFamilyStatus(),
            'orphansByAcademicLevel' => getOrphansByAcademicLevel(),
            'orphansBySponsorship' => getOrphansBySponsorship(),
            'orphansByGender' => getOrphansByGender(),
            'orphansByAge' => getOrphansByAge(),
            'orphansByZone' => getOrphansByZone(),
            'orphansByBranch' => getOrphansByBranch(),
            'orphansByPantsAndShirtSize' => getByPantsAndShirtSize(),
            'orphansByShoeSize' => getOrphansByShoeSize(),
            'orphansByVocationalTraining' => getOrphansByVocationalTraining(),
            'orphansByCreatedDate' => getOrphansGroupByCreatedDate(),
            'orphansGroupHealthStatus' => getOrphansGroupHealthStatus(),
        ]);
    }
}
