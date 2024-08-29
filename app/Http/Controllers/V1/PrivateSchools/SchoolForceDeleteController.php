<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Models\PrivateSchool;
use Illuminate\Routing\Controllers\HasMiddleware;

class SchoolForceDeleteController extends Controller implements HasMiddleware
{
    public function __invoke(PrivateSchool $school) {}

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
