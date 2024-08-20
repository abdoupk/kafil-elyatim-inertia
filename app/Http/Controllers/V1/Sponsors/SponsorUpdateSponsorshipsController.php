<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Sponsors\SponsorSponsorshipsUpdateRequest;
use App\Jobs\V1\Sponsor\SponsorUpdatedJob;
use App\Models\Sponsor;

class SponsorUpdateSponsorshipsController extends Controller
{
    public function __invoke(SponsorSponsorshipsUpdateRequest $request, Sponsor $sponsor)
    {
        $sponsor->sponsorships()->update($request->validated());

        dispatch(new SponsorUpdatedJob($sponsor, auth()->user()));

        return response('', 201);
    }
}
