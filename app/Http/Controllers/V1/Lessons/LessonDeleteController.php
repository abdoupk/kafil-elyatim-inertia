<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Models\EventOccurrence;

class LessonDeleteController extends Controller
{
    public function __invoke(EventOccurrence $lesson)
    {
        $lesson->delete();

        return redirect()->back();
    }
}
