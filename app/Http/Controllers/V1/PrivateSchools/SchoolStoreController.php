<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Schools\SchoolCreateRequest;
use App\Models\PrivateSchool;

class SchoolStoreController extends Controller
{
    public function __invoke(SchoolCreateRequest $request)
    {
        PrivateSchool::create($request->validated());

        return response('', 201);
    }
}
