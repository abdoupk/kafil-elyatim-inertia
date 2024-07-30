<?php

namespace App\Http\Controllers\V1\VocationalTrainingAchievements;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\VocationalTrainingAchievements\VocationalTrainingAchievementsUpdateRequest;
use App\Models\vocationalTrainingAchievement;

class VocationalTrainingAchievementsUpdateController extends Controller
{
    public function __invoke(VocationalTrainingAchievementsUpdateRequest $request, VocationalTrainingAchievement $vocationalTrainingAchievement)
    {
        $vocationalTrainingAchievement->update($request->validated());

        $vocationalTrainingAchievement->orphan->searchable();

        return response('', 201);
    }
}
