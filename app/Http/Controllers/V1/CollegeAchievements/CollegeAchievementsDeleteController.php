<?php

namespace App\Http\Controllers\V1\CollegeAchievements;

use App\Http\Controllers\Controller;
use App\Models\CollegeAchievement;

class CollegeAchievementsDeleteController extends Controller
{
    public function __invoke(CollegeAchievement $collegeAchievement)
    {
        $collegeAchievement->delete();

        return redirect()->back();
    }
}
