<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Schools\SchoolCreateRequest;
use App\Jobs\V1\School\SchoolCreatedJob;
use App\Models\PrivateSchool;

class SchoolStoreController extends Controller
{
    public function __invoke(SchoolCreateRequest $request)
    {
        $school = PrivateSchool::create($request->only('name'));

        $school->lessons()->createMany($request->lessons);

        dispatch(new SchoolCreatedJob($school, auth()->user()));

        return response('', 201);
    }
}
