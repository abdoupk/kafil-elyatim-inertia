<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Needs\PersonResource;
use App\Models\Sponsor;

class GetSponsorsController extends Controller
{
    public function __invoke()
    {
        return response()->json(PersonResource::collection(Sponsor::select(['id', 'first_name', 'last_name'])->get()));
    }
}
