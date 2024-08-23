<script lang="ts" setup>
import type { FinancesByTypeType } from '@/types/statistics'

import BaseLineChart from '@/Components/Base/chart/BaseLineChart.vue'

import { getColor } from '@/utils/colors'
import { abbreviationMonths } from '@/utils/constants'
import { getLocale } from '@/utils/i18n'

defineProps<{
    financesByType: FinancesByTypeType
}>()
</script>

<template>
    <base-line-chart
        :datasets="[
            {
                data: financesByType.incomes,
                borderColor: () => getColor('primary', 0.5),
                label: $t('statistics.finances.incomes')
            },
            {
                data: financesByType.expenses,
                borderColor: () => getColor('primary', 0.5),
                label: $t('statistics.finances.expenses')
            }
        ]"
        :height="300"
        :labels="abbreviationMonths[getLocale()]"
    ></base-line-chart>
</template>
