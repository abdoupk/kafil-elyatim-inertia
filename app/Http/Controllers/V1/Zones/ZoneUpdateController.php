<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Zones\ZoneUpdateRequest;
use App\Models\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ZoneUpdateController extends Controller
{
    public function __invoke(ZoneUpdateRequest $request, Zone $zone): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        $zone->update($request->validated());

        return response('', 201);
    }
}
