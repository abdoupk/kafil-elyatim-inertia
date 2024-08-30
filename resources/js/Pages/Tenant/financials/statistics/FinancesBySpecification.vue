<script lang="ts" setup>
import type { FinancesBySpecificationType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { getColor } from '@/utils/colors'
import { __ } from '@/utils/i18n'

const BaseRadarChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseRadarChart.vue'))

defineProps<{
    financesBySpecification: FinancesBySpecificationType
}>()
</script>

<template>
    <suspense v-if="!financesBySpecification.incomes.length || !financesBySpecification.expenses.length" suspensible>
        <base-radar-chart
            :datasets="[
                {
                    data: Object.values(financesBySpecification.incomes),
                    label: __('incomes'),
                    backgroundColor: () => getColor('primary', 0.4),
                    pointBackgroundColor: () => getColor('primary', 0.5),
                    pointHoverBorderColor: () => getColor('primary', 0.7)
                },
                {
                    data: Object.values(financesBySpecification.expenses),
                    label: __('expenses'),
                    backgroundColor: () => getColor('slate.300', 0.4),
                    pointBackgroundColor: () => getColor('slate.300', 0.5),
                    pointHoverBorderColor: () => getColor('slate.300', 0.7)
                }
            ]"
            :labels="Object.keys(financesBySpecification.incomes).map((key) => __(key))"
        ></base-radar-chart>
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
