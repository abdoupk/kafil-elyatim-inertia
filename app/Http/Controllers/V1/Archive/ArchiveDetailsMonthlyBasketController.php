<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Archive\MonthlyBasketArchiveIndexResource;
use App\Models\Archive;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveDetailsMonthlyBasketController extends Controller
{
    public function __invoke(Archive $archive): Response
    {
        return Inertia::render('Tenant/archive/details/monthly-basket/MonthlyBasketArchiveDetailsPage', [
            'archive' => ['id' => $archive->id],
            'orphans' => MonthlyBasketArchiveIndexResource::collection($archive->listFamilies()->paginate(request()->integer('perPage', 10))),
            'params' => getParams(),
        ]);
    }
}
