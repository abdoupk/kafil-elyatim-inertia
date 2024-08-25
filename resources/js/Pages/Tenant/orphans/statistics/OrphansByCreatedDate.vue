<script lang="ts" setup>
import type { OrphansByCreatedDateType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { getColor } from '@/utils/colors'
import { abbreviationMonths } from '@/utils/constants'
import { __, getLocale } from '@/utils/i18n'

const BaseLineChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseLineChart.vue'))

defineProps<{
    orphansByCreatedDate: OrphansByCreatedDateType
}>()
</script>

<template>
    <suspense v-if="orphansByCreatedDate.length" suspensible>
        <base-line-chart
            :datasets="[
                {
                    data: orphansByCreatedDate,
                    label: __('statistics.orphans.titles.orphans_by_created_date'),
                    borderColor: () => getColor('primary')
                }
            ]"
            :height="300"
            :labels="abbreviationMonths[getLocale()]"
        ></base-line-chart>
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
