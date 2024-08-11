<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Schools\SchoolUpdateRequest;
use App\Models\PrivateSchool;

class SchoolUpdateController extends Controller
{
    public function __invoke(SchoolUpdateRequest $request, PrivateSchool $school)
    {
        $school->update($request->only('name'));

        $school->lessons()->forceDelete();

        collect($request->lessons)->each(function ($lesson) use ($school) {
            $school->lessons()->create($lesson);
        });

        return response('', 201);
    }
}
