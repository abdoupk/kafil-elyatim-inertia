<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Models\PrivateSchool;
use Illuminate\Http\Resources\Json\JsonResource;

class ListSchoolsController extends Controller
{
    public function __invoke()
    {
        return response()->json(JsonResource::collection(PrivateSchool::select(['id', 'name'])->get()));
    }
}
