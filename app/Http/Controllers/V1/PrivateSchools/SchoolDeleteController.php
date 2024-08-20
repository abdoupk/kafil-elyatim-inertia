<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Jobs\V1\School\SchoolTrashedJob;
use App\Models\PrivateSchool;

class SchoolDeleteController extends Controller
{
    public function __invoke(PrivateSchool $school)
    {
        $school->delete();

        dispatch(new SchoolTrashedJob($school, auth()->user()));

        return redirect()->back();
    }
}
