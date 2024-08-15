<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Occasions\BabyMilkAndDiapersResource;
use App\Models\Archive;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveDetailsBabiesMilkAndDiapersController extends Controller
{
    public function __invoke(Archive $archive): Response
    {
        return Inertia::render('Tenant/archive/details/babies-milk-and-diapers/BabiesMilkAndDiapersArchiveDetailsPage', [
            'orphans' => BabyMilkAndDiapersResource::collection($archive->listBabies()->paginate()),
            'params' => getParams(),
        ]);
    }
}
