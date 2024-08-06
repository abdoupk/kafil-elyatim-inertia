<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilySponsorShipsUpdateRequest;
use App\Models\Family;

class FamilyUpdateSponsorShipsController extends Controller
{
    public function __invoke(FamilySponsorShipsUpdateRequest $request, Family $family)
    {
        $family->sponsorships()->update($request->validated());

        return response('', 201);
    }
}
