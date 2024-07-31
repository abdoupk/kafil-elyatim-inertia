<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Needs\PersonResource;
use App\Models\Family;

class ListFamiliesController extends Controller
{
    public function __invoke()
    {
        return response()->json(PersonResource::collection(Family::select(['id', 'name'])->get()));
    }
}
