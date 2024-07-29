<?php

namespace App\Http\Controllers\V1\VocationalTrainingAchievements;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\VocationalTrainingAchievements\VocationalTrainingAchievementShowResource;
use App\Models\vocationalTrainingAchievement;

class VocationalTrainingAchievementsShowController extends Controller
{
    public function __invoke(VocationalTrainingAchievement $vocationalTrainingAchievement)
    {
        return response()->json([
            'vocational_training_achievement' => new VocationalTrainingAchievementShowResource($vocationalTrainingAchievement),
        ]);
    }
}
