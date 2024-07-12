<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Models\Finance;

class FinancialDeleteController extends Controller
{
    public function __invoke(Finance $finance)
    {
        $finance->delete();

        return redirect()->back();
    }
}
