<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Schools\SchoolResource;
use App\Models\PrivateSchool;

class SchoolShowController extends Controller
{
    public function __invoke(PrivateSchool $school)
    {
        return response()->json([
            'school' => SchoolResource::make($school),
        ]);
    }
}
