<?php

namespace App\Http\Controllers\V1\SiteSettings;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SiteSettings\UpdateCalculationWeightsRequest;

class UpdateCalculationWeightsController extends Controller
{
    public function __invoke(UpdateCalculationWeightsRequest $request)
    {
        ray($request->validated());

        auth()->user()->tenant->update([
            'calculation' => json_encode($request->validated()),
        ]);

        return response('', 204);
    }
}
