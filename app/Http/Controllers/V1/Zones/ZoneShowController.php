<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\JsonResponse;

class ZoneShowController extends Controller
{
    public function __invoke(Zone $zone): JsonResponse
    {
        return response()->json([
            'zone' => $zone,
        ]);
    }
}
