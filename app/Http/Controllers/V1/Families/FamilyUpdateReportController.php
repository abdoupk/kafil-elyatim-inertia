<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilyReportUpdateRequest;
use App\Models\Family;

class FamilyUpdateReportController extends Controller
{
    public function __invoke(FamilyReportUpdateRequest $request, Family $family)
    {
        $family->preview()->update($request->except('inspectors'));

        $family->preview->inspectors()->sync($request->input('inspectors'));

        return response('', 201);
    }
}
