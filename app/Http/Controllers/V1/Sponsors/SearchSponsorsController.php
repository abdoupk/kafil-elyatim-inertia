<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Needs\PersonResource;

class SearchSponsorsController extends Controller
{
    public function __invoke()
    {
        return PersonResource::collection(searchSponsors());
    }
}
