<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Models\Finance;

class FinancialForceDeleteController extends Controller
{
    public function __invoke(Finance $finance) {}
}
