<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Sponsors\SponsorInfosUpdateRequest;
use App\Models\Sponsor;

class SponsorUpdateInfosController extends Controller
{
    public function __invoke(SponsorInfosUpdateRequest $request, Sponsor $sponsor)
    {
        $sponsor->update($request->validated());

        return response('', 201);
    }
}
