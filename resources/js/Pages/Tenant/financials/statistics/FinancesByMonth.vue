<script lang="ts" setup>
import type { FinancesByMonthType } from '@/types/statistics'

import { router } from '@inertiajs/vue3'

import ReportLineChart from '@/Pages/Tenant/dashboard/financial-report/ReportLineChart.vue'

defineProps<{
    financesByMonth: FinancesByMonthType
}>()

const handleChange = (specification: string) => {
    router.get(
        route('tenant.financial.statistics'),
        {
            specification
        },
        {
            preserveState: true,
            preserveScroll: true,
            only: ['financesByMonth']
        }
    )
}
</script>

<template>
    <suspense suspensible>
        <ReportLineChart :financialReports="financesByMonth" :height="300"></ReportLineChart>
    </suspense>
</template>
