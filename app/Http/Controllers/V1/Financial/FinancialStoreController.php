<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Financial\FinancialCreateRequest;
use App\Jobs\V1\Finance\FinanceCreatedJob;
use App\Models\Finance;
use Illuminate\Routing\Controllers\HasMiddleware;

class FinancialStoreController extends Controller implements HasMiddleware
{
    public function __invoke(FinancialCreateRequest $request)
    {
        $finance = Finance::create([
            ...$request->only(['specification', 'date', 'description']),
            'received_by' => $request->only('member_id')['member_id'],
            'amount' => $request->type === 'income' ? abs($request->amount) : abs($request->amount) * -1,
        ]);

        dispatch(new FinanceCreatedJob($finance, auth()->user()));

        return response('', 201);
    }

    public static function middleware()
    {
        return ['can:create_financial_transactions'];
    }
}
