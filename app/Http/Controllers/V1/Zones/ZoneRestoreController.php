<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Models\Zone;

class ZoneRestoreController extends Controller
{
    public function __invoke(Zone $zone)
    {
        $zone->restore();

        return redirect()->back();
    }
}
