<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Financial\FinancialUpdateRequest;
use App\Models\Finance;

class FinancialUpdateController extends Controller
{
    public function __invoke(FinancialUpdateRequest $request, Finance $finance)
    {
        $finance->update($request->only(['specification', 'amount', 'description', 'date']));

        return response('', 201);
    }
}
