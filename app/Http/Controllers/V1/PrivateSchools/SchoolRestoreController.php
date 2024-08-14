<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Models\PrivateSchool;

class SchoolRestoreController extends Controller
{
    public function __invoke(PrivateSchool $school) {}
}
