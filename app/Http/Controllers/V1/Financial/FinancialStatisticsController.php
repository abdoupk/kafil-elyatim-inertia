<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Inertia\Inertia;
use Inertia\Response;

class FinancialStatisticsController extends Controller implements HasMiddleware
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/financials/statistics/FinancialStatisticsPage', [
            'financesBySpecification' => fn () => getFinancesBySpecification(),
            'financesByType' => fn () => getFinancesByType(),
            'financesByMonth' => fn () => getFinancesByMonth(),
        ]);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
