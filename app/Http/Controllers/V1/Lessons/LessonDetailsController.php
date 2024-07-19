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
        return Inertia::render('Tenant/lessons/details/LessonDetailPage', [
            'lesson' => $lesson,
        ]);
    }
}
