<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lessons\LessonUpdateRequest;
use App\Models\EventOccurrence;

class LessonUpdateController extends Controller
{
    public function __invoke(LessonUpdateRequest $request, EventOccurrence $eventOccurrence)
    {
        //TODO add to ask if update only this occurrence or all occurrences

        if (! $request->update_this_and_all_coming) {
            $eventOccurrence->update($request->only(['start_date', 'end_date']));
        } else {
            //            TODO add to update all occurrences
            $eventOccurrence->orphans()->sync($request->orphans);
        }

    }
}
