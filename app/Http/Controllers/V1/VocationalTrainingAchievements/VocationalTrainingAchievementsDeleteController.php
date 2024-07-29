<?php

namespace App\Http\Controllers\V1\VocationalTrainingAchievements;

use App\Http\Controllers\Controller;
use App\Models\vocationalTrainingAchievement;

class VocationalTrainingAchievementsDeleteController extends Controller
{
    public function __invoke(VocationalTrainingAchievement $vocationalTrainingAchievement)
    {
        $vocationalTrainingAchievement->delete();

        return redirect()->back();
    }
}
