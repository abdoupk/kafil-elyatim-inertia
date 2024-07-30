<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Sponsors\SponsorIncomesUpdateRequest;
use App\Models\Sponsor;

class SponsorUpdateIncomesController extends Controller
{
    public function __invoke(SponsorIncomesUpdateRequest $request, Sponsor $sponsor)
    {
        $sponsor->incomes()->update($request->validated());

        return response('', 201);
    }
}
