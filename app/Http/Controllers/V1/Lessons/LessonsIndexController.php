<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Lessons\SchoolsResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Inertia\Inertia;

class LessonsIndexController extends Controller implements HasMiddleware
{
    public function __invoke()
    {
        //TODO: use search with filter orphan has private lessons sponsorship
        //        $orphans = Orphan::whereHas('sponsorships', function ($query) {
        //            $query->where('private_lessons', '!=', 0)
        //                ->orWhere('private_lessons', '!=', null)
        //                ->orWhere('private_lessons', '!=', false);
        //        })->get();

        return Inertia::render('Tenant/lessons/index/LessonsIndexPage', [
            'schools' => SchoolsResource::collection(getSchoolsForAddLesson()),
            'events' => getLessons(),
        ]);
    }

    public static function middleware()
    {
        return ['can:list_lessons'];
    }
}
