<script lang="ts" setup>
import type { OrphansByCreatedDateType } from '@/types/statistics'

import BaseLineChart from '@/Components/Base/chart/BaseLineChart.vue'

import { getColor } from '@/utils/colors'
import { abbreviationMonths } from '@/utils/constants'
import { __, getLocale } from '@/utils/i18n'

const props = defineProps<{
    orphansByCreatedDate: OrphansByCreatedDateType
}>()

console.log(props.orphansByCreatedDate)
</script>

<template>
    <base-line-chart
        :datasets="[
            {
                data: props.orphansByCreatedDate,
                label: __('statistics.orphans.titles.orphans_by_created_date'),
                borderColor: () => getColor('primary')
            }
        ]"
        :height="300"
        :labels="abbreviationMonths[getLocale()]"
    ></base-line-chart>
</template>
