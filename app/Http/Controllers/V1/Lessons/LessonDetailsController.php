<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Models\EventOccurrence;
use Inertia\Inertia;
use Inertia\Response;

class LessonDetailsController extends Controller
{
    public function __invoke(EventOccurrence $lesson): Response
    {
        ray($lesson->load('event.orphans', 'event.school', 'event.subject'));

        return Inertia::render('Tenant/lessons/details/LessonDetailPage', [
            'lesson' => $lesson->load('event.orphans', 'event.school', 'event.subject'),
        ]);
    }
}
