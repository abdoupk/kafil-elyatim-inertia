<script lang="ts" setup>
import { defineAsyncComponent } from 'vue'

import FamiliesByStartDateThisYearChart from '@/Pages/Tenant/families/statistics/FamiliesByStartDateThisYearChart.vue'

import TheChartLoader from '@/Components/Global/TheChartLoader.vue'

import { abbreviationMonths } from '@/utils/constants'
import { __, getLocale } from '@/utils/i18n'

const BaseLineChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseLineChart.vue'))

defineProps<{
    familiesGroupByDate: number[]
}>()
</script>

<template>
    <suspense>
        <families-by-start-date-this-year-chart
            :datasets="[
                {
                    data: familiesGroupByDate,
                    label: __('families_count')
                }
            ]"
            :height="250"
            :labels="abbreviationMonths[getLocale()]"
        ></families-by-start-date-this-year-chart>

        <template #fallback>
            <the-chart-loader></the-chart-loader>
        </template>
    </suspense>
</template>
