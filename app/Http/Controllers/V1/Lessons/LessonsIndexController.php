<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Lessons\SchoolsResource;
use App\Models\Orphan;
use Inertia\Inertia;
use Recurr\Exception\InvalidArgument;
use Recurr\Exception\InvalidWeekday;

class LessonsIndexController extends Controller
{
    /**
     * @throws InvalidArgument
     * @throws InvalidWeekday
     */
    public function __invoke()
    {
        //TODO: use search with filter orphan has private lessons sponsorship
        $orphans = Orphan::whereHas('sponsorships', function ($query) {
            $query->where('private_lessons', '!=', 0)
                ->orWhere('private_lessons', '!=', null)
                ->orWhere('private_lessons', '!=', false);
        })->get();

        ray(SchoolsResource::collection(getSchoolsForAddLesson()));

        return Inertia::render('Tenant/lessons/index/LessonsIndexPage', [
            'schools' => SchoolsResource::collection(getSchoolsForAddLesson()),
            'events' => getLessons(),
        ]);
    }
}
