<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Schools\SchoolsIndexResource;
use Inertia\Inertia;

class SchoolsIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/schools/index/SchoolsIndexPage', [
            'schools' => SchoolsIndexResource::collection(getSchools()),
            'params' => getParams(),
        ]);
    }
}
