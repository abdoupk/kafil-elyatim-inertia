<?php

use App\Models\Finance;

function generateGlobalDashBoardReportStatistics(): array
{
    $currentMonth = date('m');
    $currentYear = date('Y');
    $previousMonth = date('m', strtotime('-1 month'));
    $previousYear = date('Y', strtotime('-1 month'));

    return [
        'members' => getStatisticsForDashboardReport('users', $currentMonth, $currentYear, $previousMonth, $previousYear),
        'orphans' => getStatisticsForDashboardReport('orphans', $currentMonth, $currentYear, $previousMonth, $previousYear),
        'branches' => getStatisticsForDashboardReport('branches', $currentMonth, $currentYear, $previousMonth, $previousYear),
        'families' => getStatisticsForDashboardReport('families', $currentMonth, $currentYear, $previousMonth, $previousYear),
    ];
}

function getStatisticsForDashboardReport($table, $currentMonth, $currentYear, $previousMonth, $previousYear): array
{
    /** @noinspection PhpUnnecessaryCurlyVarSyntaxInspection */
    $result = DB::table($table)
        ->selectRaw("
             (SELECT COUNT(*) FROM {$table} where (tenant_id = ?) and deleted_at is null) AS total_count,
        (SELECT COUNT(*) FROM {$table} WHERE EXTRACT(MONTH FROM created_at) = ? AND EXTRACT(YEAR FROM created_at) = ? AND (tenant_id = ?))  AS current_month_count,
        (SELECT COUNT(*) FROM {$table} WHERE EXTRACT(MONTH FROM created_at) = ? AND EXTRACT(YEAR FROM created_at) = ? AND (tenant_id = ?))  AS previous_month_count
    ", [auth()->user()->tenant_id, $currentMonth, $currentYear, auth()->user()->tenant_id, $previousMonth, $previousYear, auth()->user()->tenant_id])
        ->first();

    return [
        'total' => (int) $result?->total_count,
        'percentageDifference' => (int) $result?->previous_month_count === 0 ? 0 : number_format(($result?->current_month_count - $result?->previous_month_count) / $result?->previous_month_count * 100),
    ];
}

function generateFinancialReport(): array
{
    $year = date('Y');

    $monthIndex = date('n') - 1;

    $data = DB::table('finances')
        ->selectRaw('CASE WHEN amount >= 0 THEN \'incomes\' ELSE \'expenses\' END AS sign, EXTRACT(MONTH FROM created_at) as month, SUM(amount) as total')
        ->whereYear('created_at', $year)
        ->where('tenant_id', tenant('id'))
        ->where(function ($q) {
            $specification = request()->input('specification', '');

            if ($specification) {
                return $q->where('specification', '=', $specification);
            }

            return $q;
        })
        ->groupBy('sign', 'month')
        ->get();

    // Create an array to store the final result
    $result = [
        'incomes' => array_fill(0, 12, 0),
        'expenses' => array_fill(0, 12, 0),
    ];

    // Loop through the data and populate the result array
    foreach ($data as $row) {
        $result[$row->sign][$row->month - 1] = abs($row->total);
    }

    $result['totalLastMonth'] = $result['incomes'][$monthIndex - 1] + $result['expenses'][$monthIndex - 1];

    $result['totalThisMonth'] = $result['incomes'][$monthIndex] + $result['expenses'][$monthIndex];

    return $result;
}

function generateTest(): array
{
    $year = date('Y');

    return Finance::selectRaw('
            EXTRACT(MONTH FROM created_at) as month, SUM(CASE WHEN amount < 0 THEN amount ELSE 0 END) as negative_amount, SUM(CASE WHEN amount >= 0 THEN amount ELSE 0 END) as positive_amount, specification
        ')
        ->whereYear('created_at', $year)
        ->groupBy('specification', 'month')
        ->get()
        ->groupBy('specification')
        ->map(function ($items) {
            $monthlyTotals = array_fill(0, 12, ['positive' => 0, 'negative' => 0]);

            $items->each(function ($item) use (&$monthlyTotals) {
                $monthIndex = $item->month - 1;
                $monthlyTotals[$monthIndex]['positive'] = $item->positive_amount;
                $monthlyTotals[$monthIndex]['negative'] = abs($item->negative_amount);
            });

            return $monthlyTotals;
        })->toArray();
}
