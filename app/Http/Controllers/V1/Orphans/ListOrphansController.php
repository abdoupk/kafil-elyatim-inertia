<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Needs\PersonResource;
use App\Models\Orphan;

class ListOrphansController extends Controller
{
    public function __invoke()
    {
        return response()->json(PersonResource::collection(Orphan::select(['id', 'first_name', 'last_name'])->get()));
    }
}
