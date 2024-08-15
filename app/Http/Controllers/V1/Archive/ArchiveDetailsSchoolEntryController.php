<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Archive\SchoolEntryArchiveIndexResource;
use App\Models\Archive;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveDetailsSchoolEntryController extends Controller
{
    public function __invoke(Archive $archive): Response
    {
        return Inertia::render('Tenant/archive/details/school-entry/SchoolEntryArchiveDetailsPage', [
            'archive' => ['id' => $archive->id],
            'orphans' => SchoolEntryArchiveIndexResource::collection($archive->listOrphans()->paginate(request()->integer('perPage', 10))),
            'params' => getParams(),
        ]);
    }
}
