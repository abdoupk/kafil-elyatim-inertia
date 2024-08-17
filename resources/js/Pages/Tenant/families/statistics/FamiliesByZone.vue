<script lang="ts" setup>
import type { FamiliesByZoneType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheChartLoader from '@/Components/Global/TheChartLoader.vue'

const BasePieChart = defineAsyncComponent(() => import('@/Components/Base/chart/BasePieChart.vue'))

defineProps<{
    familiesByZone: FamiliesByZoneType
}>()
</script>

<template>
    <suspense>
        <base-pie-chart
            :chart-colors="['#ff0000', '#f50022', '#250022', '#452025', '#131313']"
            :chart-data="familiesByZone.data"
            :labels="familiesByZone.labels"
        ></base-pie-chart>

        <template #fallback>
            <the-chart-loader></the-chart-loader>
        </template>
    </suspense>
</template>
