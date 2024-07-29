<?php

namespace App\Http\Controllers\V1\CollegeAchievements;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CollegeAchievements\CollegeAchievementsUpdateRequest;
use App\Models\CollegeAchievement;

class CollegeAchievementsUpdateController extends Controller
{
    public function __invoke(CollegeAchievementsUpdateRequest $request, CollegeAchievement $collegeAchievement)
    {
        $collegeAchievement->update($request->validated());

        $collegeAchievement->orphan->searchable();

        return response('', 201);
    }
}
