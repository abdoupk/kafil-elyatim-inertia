<script lang="ts" setup>
import { defineAsyncComponent } from 'vue'

import TheChartLoader from '@/Components/Global/TheChartLoader.vue'

import { getColor } from '@/utils/colors'
import { abbreviationMonths } from '@/utils/constants'
import { getLocale } from '@/utils/i18n'

const BaseLineChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseLineChart.vue'))

defineProps<{
    familiesGroupByDate: number[]
}>()
</script>

<template>
    <suspense>
        <base-line-chart
            :datasets="[
                {
                    data: familiesGroupByDate,
                    borderColor: () => getColor('primary', 0.8),
                    label: 'orphan_families'
                }
            ]"
            :height="250"
            :labels="abbreviationMonths[getLocale()]"
        ></base-line-chart>

        <template #fallback>
            <the-chart-loader></the-chart-loader>
        </template>
    </suspense>
</template>
