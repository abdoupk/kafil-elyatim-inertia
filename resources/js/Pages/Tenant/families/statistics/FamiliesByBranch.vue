<script lang="ts" setup>
import type { FamiliesByBranchType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheChartLoader from '@/Components/Global/TheChartLoader.vue'

const BasePieChart = defineAsyncComponent(() => import('@/Components/Base/chart/BasePieChart.vue'))

defineProps<{
    familiesByBranch: FamiliesByBranchType
}>()
</script>

<template>
    <suspense>
        <base-pie-chart :chart-data="familiesByBranch.data" :labels="familiesByBranch.labels"></base-pie-chart>

        <template #fallback>
            <the-chart-loader></the-chart-loader>
        </template>
    </suspense>
</template>
