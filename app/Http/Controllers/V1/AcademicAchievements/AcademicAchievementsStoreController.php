<?php

namespace App\Http\Controllers\V1\AcademicAchievements;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AcademicAchievements\AcademicAchievementsCreateRequest;
use App\Models\AcademicAchievement;

class AcademicAchievementsStoreController extends Controller
{
    public function __invoke(AcademicAchievementsCreateRequest $request)
    {
        AcademicAchievement::create($request->validated());

        return response('', 201);
    }
}
