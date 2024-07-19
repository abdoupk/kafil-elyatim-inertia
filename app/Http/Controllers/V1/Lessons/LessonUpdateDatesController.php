<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lessons\LessonUpdateDatesRequest;
use App\Models\EventOccurrence;

class LessonUpdateDatesController extends Controller
{
    public function __invoke(LessonUpdateDatesRequest $request, EventOccurrence $lesson)
    {
        $lesson->update($request->validated());
    }
}
