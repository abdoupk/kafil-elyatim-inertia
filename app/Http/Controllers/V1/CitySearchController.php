<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitySearchResource;
use App\Models\City;

class CitySearchController extends Controller
{
    public function __invoke()
    {
        //TODO fix to search
        return CitySearchResource::collection(search(City::getModel(), limit: 100)->get());
    }
}
