<?php

namespace App\Http\Controllers\V1\Zones;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;

class ZoneDeleteController extends Controller
{
    public function __invoke(Zone $zone): RedirectResponse
    {
        $zone->delete();

        return redirect()->back();
    }
}
