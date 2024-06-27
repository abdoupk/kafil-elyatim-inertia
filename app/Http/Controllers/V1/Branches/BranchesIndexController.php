<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Branches\BranchesResource;
use Inertia\Inertia;
use Inertia\Response;

class BranchesIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/branches/BranchesIndexPage', [
            'branches' => BranchesResource::collection(getBranches()),
            'params' => getParams(),
        ]);
    }
}
