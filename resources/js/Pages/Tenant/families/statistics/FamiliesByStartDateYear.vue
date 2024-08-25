<script lang="ts" setup>
import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { abbreviationMonths } from '@/utils/constants'
import { __, getLocale } from '@/utils/i18n'

const FamiliesByStartDateThisYearChart = defineAsyncComponent(
    () => import('@/Pages/Tenant/families/statistics/FamiliesByStartDateThisYearChart.vue')
)

defineProps<{
    familiesGroupByDate: number[]
}>()
</script>

<template>
    <suspense v-if="familiesGroupByDate.length" suspensible>
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
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
