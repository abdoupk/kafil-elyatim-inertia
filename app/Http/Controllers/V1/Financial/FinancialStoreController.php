<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Financial\FinancialCreateRequest;
use App\Models\Finance;

class FinancialStoreController extends Controller
{
    public function __invoke(FinancialCreateRequest $request)
    {
        ray($request->only('member_id'));
        Finance::create([
            ...$request->only(['specification', 'date', 'description']),
            'created_by' => $request->only('member_id')['member_id'],
            'amount' => $request->type == 'income' ? $request->amount : $request->amount * -1,
        ]);

        return response('', 201);
    }
}
