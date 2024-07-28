<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lessons\LessonCreateRequest;
use App\Models\EventOccurrence;

class LessonUpdateController extends Controller
{
    public function __invoke(LessonCreateRequest $request, EventOccurrence $eventOccurrence)
    {
        $eventOccurrence->update($request->except(['orphans']));

        $eventOccurrence->orphans()->sync($request->orphans);
    }
}
