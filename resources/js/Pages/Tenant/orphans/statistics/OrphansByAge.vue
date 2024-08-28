<script lang="ts" setup>
import type { OrphansByAgeType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { getColor } from '@/utils/colors'
import { __ } from '@/utils/i18n'

const BaseHorizontalBarChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseHorizontalBarChart.vue'))

defineProps<{
    orphansByAge: OrphansByAgeType
}>()
</script>

<template>
    <suspense v-if="orphansByAge.data.length" suspensible>
        <base-horizontal-bar-chart
            :datasets="[
                {
                    data: orphansByAge.data,
                    label: __('orphans_count'),
                    backgroundColor: () => getColor('primary', 0.9)
                }
            ]"
            :height="300"
            :labels="orphansByAge.age"
        ></base-horizontal-bar-chart>
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
