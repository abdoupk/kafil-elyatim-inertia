<script lang="ts" setup>
import type { FamiliesSponsorShipsType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheChartLoader from '@/Components/Global/TheChartLoader.vue'

import { getColor } from '@/utils/colors'

const BaseRadarChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseRadarChart.vue'))

defineProps<{
    familiesSponsorShips: FamiliesSponsorShipsType
}>()
</script>

<template>
    <suspense>
        <base-radar-chart
            :datasets="[
                {
                    data: Object.values(familiesSponsorShips),
                    label: 'orphan_families',
                    backgroundColor: () => getColor('primary', 0.3),
                    borderColor: () => getColor('primary', 0.8),
                    pointBackgroundColor: () => getColor('primary', 0.8),
                    pointHoverBorderColor: () => getColor('primary', 0.8)
                }
            ]"
            :labels="['ramadan_basket_count', 'zakat_count', 'housing_assistance_count', 'eid_al_adha_count']"
        ></base-radar-chart>

        <template #fallback>
            <the-chart-loader></the-chart-loader>
        </template>
    </suspense>
</template>
