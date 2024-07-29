<?php

namespace App\Http\Controllers\V1\VocationalTrainingAchievements;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\VocationalTrainingAchievements\VocationalTrainingAchievementsCreateRequest;
use App\Models\vocationalTrainingAchievement;

class VocationalTrainingAchievementsStoreController extends Controller
{
    public function __invoke(VocationalTrainingAchievementsCreateRequest $request)
    {
        VocationalTrainingAchievement::create($request->validated());

        return response('', 201);
    }
}
