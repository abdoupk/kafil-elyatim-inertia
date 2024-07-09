<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Needs\NeedsIndexResource;
use Inertia\Inertia;
use Inertia\Response;

class NeedsIndexController extends Controller
{
    public function __invoke(): Response
    {
        ray(getNeeds());

        return Inertia::render('Tenant/needs/index/NeedsIndexPage', [
            'needs' => NeedsIndexResource::collection(getNeeds()),
            'params' => getParams(),
        ]);
    }
}
