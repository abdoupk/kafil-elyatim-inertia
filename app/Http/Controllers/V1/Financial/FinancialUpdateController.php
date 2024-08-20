<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Financial\FinancialUpdateRequest;
use App\Jobs\V1\Finance\FinanceUpdatedJob;
use App\Models\Finance;

class FinancialUpdateController extends Controller
{
    public function __invoke(FinancialUpdateRequest $request, Finance $finance)
    {
        $finance->update([
            ...$request->only(['specification', 'description', 'date']),
            'amount' => $request->type == 'income' ? abs($request->amount) : abs($request->amount) * -1,
        ]);

        dispatch(new FinanceUpdatedJob($finance, auth()->user()));

        return response('', 201);
    }
}
