<script lang="ts" setup>
import type { FamiliesByZoneType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

const BasePieChart = defineAsyncComponent(() => import('@/Components/Base/chart/BasePieChart.vue'))

defineProps<{
    familiesByZone: FamiliesByZoneType
}>()
</script>

<template>
    <suspense>
        <base-pie-chart
            v-if="familiesByZone.data?.length"
            :chart-data="familiesByZone.data"
            :labels="familiesByZone.labels"
        ></base-pie-chart>

        <the-no-data-chart v-else></the-no-data-chart>
    </suspense>
</template>
