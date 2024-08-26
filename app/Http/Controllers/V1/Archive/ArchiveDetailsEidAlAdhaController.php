<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Archive\EidAlAdhaArchiveIndexResource;
use App\Models\Archive;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveDetailsEidAlAdhaController extends Controller
{
    public function __invoke(Archive $archive): Response
    {
        return Inertia::render('Tenant/archive/details/eid-al-adha/EidAlAdhaIndexArchiveDetailsPage', [
            'archive' => ['id' => $archive->id],
            'families' => EidAlAdhaArchiveIndexResource::collection($archive->listFamilies()->with(['zone:id,name', 'branch:id,name', 'sponsor.incomes', 'secondSponsor:id,family_id,income', 'orphans'])->withCount('orphans')->paginate(request()->integer('perPage', 10))),
            'params' => getParams(),
        ]);
    }
}
