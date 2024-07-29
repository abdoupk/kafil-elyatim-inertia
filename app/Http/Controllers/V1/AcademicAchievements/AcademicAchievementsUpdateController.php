<?php

namespace App\Http\Controllers\V1\AcademicAchievements;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AcademicAchievements\AcademicAchievementsUpdateRequest;
use App\Models\AcademicAchievement;

class AcademicAchievementsUpdateController extends Controller
{
    public function __invoke(AcademicAchievementsUpdateRequest $request, AcademicAchievement $academicAchievement)
    {
        $academicAchievement->update($request->validated());

        $academicAchievement->orphan->searchable();

        return response('', 201);
    }
}
