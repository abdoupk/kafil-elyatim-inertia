<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Orphans\OrphansIndexResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Inertia\Inertia;
use Inertia\Response;

class OrphansIndexController extends Controller implements HasMiddleware
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/orphans/index/OrphansIndexPage', [
            'orphans' => OrphansIndexResource::collection(getOrphans()),
            'params' => getParams(),
        ]);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
