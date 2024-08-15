<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Archive\EidSuitArchiveIndexResource;
use App\Models\Archive;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveDetailsEidSuitController extends Controller
{
    public function __invoke(Archive $archive): Response
    {
        ray($archive->listOrphans()->paginate());

        return Inertia::render('Tenant/archive/details/eid-suit/EidSuitArchiveDetailsPage', [
            'archive' => ['id' => $archive->id],
            'orphans' => EidSuitArchiveIndexResource::collection($archive->listOrphans()->paginate(request()->integer('perPage', 10))),
            'params' => getParams(),
        ]);
    }
}
