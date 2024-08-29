<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Lessons\OrphansResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class ListOrphansController extends Controller implements HasMiddleware
{
    public function __invoke(Request $request)
    {
        return OrphansResource::collection(getOrphansForAddLesson());
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
