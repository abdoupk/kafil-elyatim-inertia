<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Archive\RamadanBasketArchiveIndexResource;
use App\Models\Archive;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveDetailsRamadanBasketController extends Controller
{
    public function __invoke(Archive $archive): Response
    {
        return Inertia::render('Tenant/archive/details/ramadan-basket/RamadanBasketArchiveDetailsPage', [
            'archive' => ['id' => $archive->id],
            'orphans' => RamadanBasketArchiveIndexResource::collection($archive->listFamilies()->paginate(request()->integer('perPage', 10))),
            'params' => getParams(),
        ]);
    }
}
