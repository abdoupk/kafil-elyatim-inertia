<?php

namespace App\Http\Controllers\V1\AcademicAchievements;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AcademicAchievements\AcademicAchievementResource;
use App\Models\AcademicAchievement;

class AcademicAchievementsShowController extends Controller
{
    public function __invoke(AcademicAchievement $academicAchievement)
    {
        return response()->json([
            'academic_achievement' => new AcademicAchievementResource($academicAchievement),
        ]);
    }
}
