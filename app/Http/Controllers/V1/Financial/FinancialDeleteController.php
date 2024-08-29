<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Finance\FinanceTrashedJob;
use App\Models\Finance;
use Illuminate\Routing\Controllers\HasMiddleware;

class FinancialDeleteController extends Controller implements HasMiddleware
{
    public function __invoke(Finance $finance)
    {
        $finance->delete();

        dispatch(new FinanceTrashedJob($finance, auth()->user()));

        return redirect()->back();
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
