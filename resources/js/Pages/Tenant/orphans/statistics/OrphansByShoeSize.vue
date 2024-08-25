<script lang="ts" setup>
import type { OrphansByShoeSizeType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

const BaseBubbleChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseBubbleChart.vue'))

defineProps<{
    orphansByShoeSize: OrphansByShoeSizeType
}>()
</script>

<template>
    <suspense v-if="orphansByShoeSize.data.length" suspensible>
        <base-bubble-chart
            :datasets="[{ data: orphansByShoeSize.data, label: 'Orphans' }]"
            :height="300"
            :labels="orphansByShoeSize.labels"
        ></base-bubble-chart>
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
