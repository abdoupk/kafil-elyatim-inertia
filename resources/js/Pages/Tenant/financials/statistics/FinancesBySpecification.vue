<script lang="ts" setup>
import type { FinancesBySpecificationType } from '@/types/statistics'

import BaseRadarChart from '@/Components/Base/chart/BaseRadarChart.vue'

import { getColor } from '@/utils/colors'
import { __ } from '@/utils/i18n'

defineProps<{
    financesBySpecification: FinancesBySpecificationType
}>()
</script>

<template>
    <base-radar-chart
        :datasets="[
            {
                data: Object.values(financesBySpecification.incomes),
                label: $t('incomes'),
                backgroundColor: () => getColor('primary', 0.5),
                borderColor: () => getColor('primary', 0.5),
                pointBackgroundColor: () => getColor('primary', 0.5),
                pointHoverBorderColor: () => getColor('primary', 0.5)
            },
            {
                data: Object.values(financesBySpecification.expenses),
                label: $t('expense'),
                backgroundColor: () => getColor('primary', 0.5),
                borderColor: () => getColor('primary', 0.5),
                pointBackgroundColor: () => getColor('primary', 0.5),
                pointHoverBorderColor: () => getColor('primary', 0.5)
            }
        ]"
        :labels="Object.keys(financesBySpecification.incomes).map((key) => __(key))"
    ></base-radar-chart>
</template>
