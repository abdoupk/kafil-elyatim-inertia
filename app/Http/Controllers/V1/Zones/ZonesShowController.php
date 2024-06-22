<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Models\Zone;

class ZonesShowController extends Controller
{
    public function __invoke(Zone $zone)
    {
        return response()->json([
            'zone' => $zone,
        ]);
    }
}
