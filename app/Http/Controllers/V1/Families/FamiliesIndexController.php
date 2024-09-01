<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamiliesIndexRequest;
use App\Http\Resources\V1\Families\FamiliesIndexResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Inertia\Inertia;
use Inertia\Response;

class FamiliesIndexController extends Controller implements HasMiddleware
{
    public function __invoke(FamiliesIndexRequest $request): Response
    {
        return Inertia::render('Tenant/families/index/FamiliesIndexPage', [
            'families' => FamiliesIndexResource::collection(getFamilies()),
            'params' => getParams(),
        ]);
    }

    public static function middleware()
    {
        return ['can:listt_families'];
    }
}
