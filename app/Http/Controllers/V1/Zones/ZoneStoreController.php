<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Zones\ZoneCreateRequest;
use App\Jobs\V1\Zone\ZoneCreatedJob;
use App\Models\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ZoneStoreController extends Controller
{
    public function __invoke(ZoneCreateRequest $request): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        $zone = Zone::create($request->validated());

        dispatch(new ZoneCreatedJob($zone, auth()->user()));

        return response('', 201);
    }
}
