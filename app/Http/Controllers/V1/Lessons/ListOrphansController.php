<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Lessons\OrphansResource;
use Illuminate\Http\Request;

class ListOrphansController extends Controller
{
    public function __invoke(Request $request)
    {
        return OrphansResource::collection(getOrphansForAddLesson());
    }
}
