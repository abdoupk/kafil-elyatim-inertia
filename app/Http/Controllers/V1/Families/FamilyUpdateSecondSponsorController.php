<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilySecondSponsorUpdateRequest;
use App\Models\Family;

class FamilyUpdateSecondSponsorController extends Controller
{
    public function __invoke(FamilySecondSponsorUpdateRequest $request, Family $family)
    {
        $family->secondSponsor()->update($request->validated());

        return response('', 201);
    }
}
