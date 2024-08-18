<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Zones\ZoneShowResource;
use App\Models\Zone;
use Illuminate\Http\JsonResponse;

class ZoneDetailsController extends Controller
{
    public function __invoke(Zone $zone): JsonResponse
    {
        return response()->json([
            'zone' => ZoneShowResource::make($zone->load(['creator:id,first_name,last_name'])->loadCount(['families', 'members'])),
        ]);
    }
}
