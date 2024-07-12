<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Financial\FinancialUpdateResource;
use App\Models\Finance;

class FinancialShowController extends Controller
{
    public function __invoke(Finance $finance)
    {
        return response()->json([
            'finance' => FinancialUpdateResource::make($finance),
        ]);
    }
}
