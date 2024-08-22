<script lang="ts" setup>
import type { OrphansByShoeSizeType } from '@/types/statistics'

import BaseBubbleChart from '@/Components/Base/chart/BaseBubbleChart.vue'

defineProps<{
    orphansByShoeSize: OrphansByShoeSizeType
}>()
</script>

<template>
    <base-bubble-chart
        :datasets="[{ data: orphansByShoeSize.data, label: 'Orphans' }]"
        :height="300"
        :labels="orphansByShoeSize.labels"
    ></base-bubble-chart>
</template>
