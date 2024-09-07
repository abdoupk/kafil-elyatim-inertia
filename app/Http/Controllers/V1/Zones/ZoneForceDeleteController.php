<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Routing\Controllers\HasMiddleware;

class ZoneForceDeleteController extends Controller implements HasMiddleware
{
    public function __invoke(Zone $zone)
    {
    }

    public static function middleware()
    {
        return ['can:destroy_trash'];
    }
}
