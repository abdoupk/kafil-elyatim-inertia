<script lang="ts" setup>
import type { OrphansByAgeType } from '@/types/statistics'

import BaseHorizontalBarChart from '@/Components/Base/chart/BaseHorizontalBarChart.vue'

import { getColor } from '@/utils/colors'
import { __ } from '@/utils/i18n'

defineProps<{
    orphansByAge: OrphansByAgeType
}>()
</script>

<template>
    <base-horizontal-bar-chart
        :datasets="[
            {
                data: orphansByAge.data,
                label: __('statistics.orphans.titles.orphans_by_age'),
                backgroundColor: () => getColor('primary', 0.8)
            }
        ]"
        :height="300"
        :labels="orphansByAge.age"
    ></base-horizontal-bar-chart>
</template>
