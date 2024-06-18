<?php

namespace App\Http\Controllers\V1\Dashboard;

use App\Http\Controllers\Controller;
use DB;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $previousMonth = date('m', strtotime('-1 month'));
        $previousYear = date('Y', strtotime('-1 month'));

        return Inertia::render('Tenant/dashboard/TheDashboardPage', [
            'members' => $this->get('users', $currentMonth, $currentYear, $previousMonth, $previousYear),
            'orphans' => $this->get('orphans', $currentMonth, $currentYear, $previousMonth, $previousYear),
            'branches' => $this->get('branches', $currentMonth, $currentYear, $previousMonth, $previousYear),
            'families' => $this->get('families', $currentMonth, $currentYear, $previousMonth, $previousYear),
        ]);
    }

    public function get($table, $currentMonth, $currentYear, $previousMonth, $previousYear): array
    {
        $result = DB::table($table)
            ->selectRaw("
             (SELECT COUNT(*) FROM $table where (tenant_id = ?) and deleted_at is null) AS total_count,
        (SELECT COUNT(*) FROM $table WHERE EXTRACT(MONTH FROM created_at) = ? AND EXTRACT(YEAR FROM created_at) = ? AND (tenant_id = ?))  AS current_month_count,
        (SELECT COUNT(*) FROM $table WHERE EXTRACT(MONTH FROM created_at) = ? AND EXTRACT(YEAR FROM created_at) = ? AND (tenant_id = ?))  AS previous_month_count
    ", [auth()->user()->tenant_id, $currentMonth, $currentYear, auth()->user()->tenant_id, $previousMonth, $previousYear, auth()->user()->tenant_id])
            ->first();

        return [
            'total' => (int) $result?->total_count,
            'percentageDifference' => (int) $result?->previous_month_count === 0 ? 0 : number_format(($result?->current_month_count - $result?->previous_month_count) / $result?->previous_month_count * 100),
        ];
    }
}
