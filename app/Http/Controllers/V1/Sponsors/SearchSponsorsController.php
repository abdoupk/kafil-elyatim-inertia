<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Needs\PersonResource;
use Illuminate\Routing\Controllers\HasMiddleware;

class SearchSponsorsController extends Controller implements HasMiddleware
{
    public function __invoke()
    {
        return PersonResource::collection(searchSponsors());
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
