<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Resources\Json\JsonResource;

class ListFamiliesController extends Controller
{
    public function __invoke()
    {
        return response()->json(JsonResource::collection(Family::select(['id', 'name'])->get()));
    }
}
