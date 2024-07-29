<?php

namespace App\Http\Controllers\V1\CollegeAchievements;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Orphans\CollegeAchievementResource;
use App\Models\CollegeAchievement;

class CollegeAchievementsShowController extends Controller
{
    public function __invoke(CollegeAchievement $collegeAchievement)
    {
        return response()->json([
            'college_achievement' => new CollegeAchievementResource($collegeAchievement->load('academicLevel')),
        ]);
    }
}
