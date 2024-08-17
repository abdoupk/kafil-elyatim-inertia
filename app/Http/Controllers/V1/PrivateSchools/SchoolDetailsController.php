<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Schools\SchoolShowResource;
use App\Models\PrivateSchool;

class SchoolDetailsController extends Controller
{
    public function __invoke(PrivateSchool $school)
    {
        return response()->json([
            'school' => SchoolShowResource::make($school->load(['city', 'president:id,last_name,first_name', 'creator:id,first_name,last_name'])->loadCount('families')),
        ]);
    }
}
