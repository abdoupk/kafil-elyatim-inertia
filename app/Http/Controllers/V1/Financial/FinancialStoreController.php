<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Financial\FinancialCreateRequest;
use App\Models\Finance;

class FinancialStoreController extends Controller
{
    public function __invoke(FinancialCreateRequest $request)
    {
        Finance::create([
            ...$request->only(['specification', 'date', 'description']),
            'received_by' => $request->only('member_id')['member_id'],
            'amount' => $request->type == 'income' ? abs($request->amount) : abs($request->amount) * -1,
        ]);

        return response('', 201);
    }
}
