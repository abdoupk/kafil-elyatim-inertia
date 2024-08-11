<?php

namespace App\Http\Controllers\V1\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/dashboard/TheDashboardPage', [
            'reports' => fn () => generateGlobalDashBoardReportStatistics(),
            'financialReports' => fn () => generateFinancialReport(),
            'radar' => fn () => generateTest(),
        ]);
    }
}
