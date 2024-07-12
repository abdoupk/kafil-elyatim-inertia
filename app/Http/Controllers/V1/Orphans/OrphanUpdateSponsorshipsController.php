<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Orphans\OrphanSponsorshipsUpdateRequest;
use App\Models\Orphan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class OrphanUpdateSponsorshipsController extends Controller
{
    public function __invoke(OrphanSponsorshipsUpdateRequest $request, Orphan $orphan): ResponseFactory|Application|Response
    {
        $orphan->sponsorships()->update($request->validated());

        return response('', 201);
    }
}
