<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilyInfosUpdateRequest;
use App\Models\Family;

class FamilyUpdateInfoController extends Controller
{
    public function __invoke(FamilyInfosUpdateRequest $request, Family $family)
    {
        $family->update($request->validated());

        return response('', 201);
    }
}
