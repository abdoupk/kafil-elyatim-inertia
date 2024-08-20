<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Sponsors\SponsorInfosUpdateRequest;
use App\Jobs\V1\Sponsor\SponsorUpdatedJob;
use App\Models\Sponsor;

class SponsorUpdateInfosController extends Controller
{
    public function __invoke(SponsorInfosUpdateRequest $request, Sponsor $sponsor)
    {
        $sponsor->update($request->validated());

        $sponsor->orphans->searchable();

        dispatch(new SponsorUpdatedJob($sponsor, auth()->user()));

        return response('', 201);
    }
}
