<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Models\Finance;

class FinancialRestoreController extends Controller
{
    public function __invoke(Finance $finance)
    {
        $finance->restore();

        return redirect()->back();
    }
}
