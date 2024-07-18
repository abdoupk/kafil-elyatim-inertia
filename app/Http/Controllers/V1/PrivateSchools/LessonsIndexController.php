<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\V1\Lessons\OrphansResource;
use App\Http\Resources\V1\Lessons\SchoolsResource;
use App\Models\Orphan;
use App\Models\PrivateSchool;
use App\Models\Subject;
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
        $orphans = Orphan::whereHas('sponsorships', function ($query) {
            $query->where('private_lessons', '!=', 0)
                ->orWhere('private_lessons', '!=', null)
                ->orWhere('private_lessons', '!=', false);
        })->get();

        return Inertia::render('Tenant/lessons/index/LessonsIndexPage', [
            'orphans' => OrphansResource::collection($orphans),
            'subjects' => SubjectResource::collection(Subject::all()),
            'schools' => SchoolsResource::collection(PrivateSchool::all()),
            'events' => getLessons(),
        ]);
    }
}
