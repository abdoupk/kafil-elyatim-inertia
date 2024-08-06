<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilySpouseUpdateRequest;
use App\Models\Family;

class FamilyUpdateSpouseController extends Controller
{
    public function __invoke(FamilySpouseUpdateRequest $request, Family $family)
    {
        $family->deceased()->update($request->validated());

        return response('', 201);
    }
}
