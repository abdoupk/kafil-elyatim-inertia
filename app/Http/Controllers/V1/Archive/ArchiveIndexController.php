<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Archive\ArchiveIndexResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Inertia\Inertia;

class ArchiveIndexController extends Controller implements HasMiddleware
{
    public function __invoke()
    {
        ray(getArchives());

        return Inertia::render('Tenant/archive/index/ArchiveIndexPage', [
            'items' => ArchiveIndexResource::collection(getArchives()),
            'params' => getParams(),
        ]);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
