<?php

namespace App\Http\Controllers\V1\CollegeAchievements;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CollegeAchievements\CollegeAchievementsCreateRequest;
use App\Models\CollegeAchievement;

class CollegeAchievementsStoreController extends Controller
{
    public function __invoke(CollegeAchievementsCreateRequest $request)
    {
        CollegeAchievement::create($request->validated());

        return response('', 201);
    }
}
