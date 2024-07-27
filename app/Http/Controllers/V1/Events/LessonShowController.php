<?php

namespace App\Http\Controllers\V1\Events;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Events\EventDetailsResource;
use App\Models\EventOccurrence;

class LessonShowController extends Controller
{
    public function __invoke(EventOccurrence $eventOccurrence)
    {
        return response()->json([
            'lesson' => new EventDetailsResource($eventOccurrence->load('lesson.subject', 'lesson.school', 'lesson.academicLevel', 'orphans', 'event', 'lesson.school.subjects')),
        ]);
    }
}
