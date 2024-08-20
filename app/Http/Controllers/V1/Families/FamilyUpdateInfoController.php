<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilyInfosUpdateRequest;
use App\Jobs\V1\Family\FamilyUpdatedJob;
use App\Models\Family;

class FamilyUpdateInfoController extends Controller
{
    public function __invoke(FamilyInfosUpdateRequest $request, Family $family)
    {
        $family->update($request->validated());

        dispatch(new FamilyUpdatedJob($family, auth()->user()));

        return response('', 201);
    }
}
