<?php

namespace App\Http\Controllers\V1\AcademicAchievements;

use App\Http\Controllers\Controller;
use App\Models\AcademicAchievement;

class AcademicAchievementsDeleteController extends Controller
{
    public function __invoke(AcademicAchievement $academicAchievement)
    {
        ray($academicAchievement);

        $academicAchievement->delete();

        return redirect()->back();
    }
}
