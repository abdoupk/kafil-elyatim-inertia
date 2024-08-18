<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lessons\LessonUpdateRequest;
use App\Models\EventOccurrence;

class LessonUpdateController extends Controller
{
    public function __invoke(LessonUpdateRequest $request, EventOccurrence $eventOccurrence)
    {
        if (! $request->update_this_and_all_coming) {
            $eventOccurrence->update($request->only(['start_date', 'end_date']));

        } else {
            $eventOccurrence->orphans()->detach();

            $eventOccurrence->orphans()->attach($request->orphans, ['lesson_id' => $eventOccurrence->lesson_id]);

            $eventOccurrence->event()->update($request->only(['color', 'until', 'frequency', 'title', 'start_date', 'end_date', 'interval']));

            $eventOccurrence->event->occurrences()->each(fn (EventOccurrence $eventOccurrence) => $eventOccurrence->update($request->only(['start_date', 'end_date'])));
        }
    }
}
