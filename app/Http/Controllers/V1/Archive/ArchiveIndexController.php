<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class ArchiveIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Tenant/archive/ArchiveIndexPage', [
            'items' => JsonResource::collection(getArchives()),
            'params' => getParams(),
        ]);
    }
}
