<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamiliesIndexRequest;
use App\Http\Resources\V1\Families\FamiliesIndexResource;
use Inertia\Inertia;
use Inertia\Response;

class FamiliesIndexController extends Controller
{
    public function __invoke(FamiliesIndexRequest $request): Response
    {
        return Inertia::render('Tenant/families/index/FamiliesIndexPage', [
            'families' => FamiliesIndexResource::collection(getFamilies()),
            'filters' => [
                /* @phpstan-ignore-next-line */
                'page' => (int) $request->get('page', 1),
                'search' => $request->input('search', ''),
                'perPage' => $request->input('perPage', 10),
                'fields' => $request->input('fields'),
                'directions' => $request->input('directions'),
            ],
        ]);
    }
}
