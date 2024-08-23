<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lessons\LessonUpdateRequest;
use App\Models\EventOccurrence;
use Carbon\Carbon;

class LessonUpdateController extends Controller
{
    public function __invoke(LessonUpdateRequest $request, EventOccurrence $eventOccurrence)
    {
        if (! $request->update_this_and_all_coming) {
            $eventOccurrence->update([
                'start_date' => Carbon::parse($request->start_date)->addHour(),
                'end_date' => Carbon::parse($request->start_date)->addHour(),
            ]);

        } else {
            $eventOccurrence->orphans()->detach();

            $eventOccurrence->orphans()->attach($request->orphans, ['lesson_id' => $eventOccurrence->lesson_id]);

            // TODO update coming events and generate occurrences
            $eventOccurrence->event()->update([
                ...$request->only(['color', 'until', 'frequency', 'title', 'interval']),
                'start_date' => Carbon::parse($request->start_date)->addHour(),
                'end_date' => Carbon::parse($request->start_date)->addHour(),
            ]);

            $eventOccurrence->event->occurrences()->each(fn (EventOccurrence $eventOccurrence) => $eventOccurrence->update([
                'start_date' => Carbon::parse($request->start_date)->addHour(),
                'end_date' => Carbon::parse($request->start_date)->addHour(),
            ]));
            //FIXME Update job

            //dispatch(new LessonUpdatedJob($branch, auth()->user()));
        }
    }
}
