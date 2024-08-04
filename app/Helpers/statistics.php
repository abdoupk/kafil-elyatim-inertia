<?php

function generateGlobalDashBoardStatistics(): array
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
