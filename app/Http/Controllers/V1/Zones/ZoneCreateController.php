<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Zones\ZoneCreateRequest;
use App\Models\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ZoneCreateController extends Controller
{
    public function __invoke(ZoneCreateRequest $request): Application|ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        Zone::create([...$request->validated(), 'tenant_id' => tenant('id')]);

        return response('', 201);
    }
}
