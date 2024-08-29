<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Routing\Controllers\HasMiddleware;

class FinancialForceDeleteController extends Controller implements HasMiddleware
{
    public function __invoke(Finance $finance) {}

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
