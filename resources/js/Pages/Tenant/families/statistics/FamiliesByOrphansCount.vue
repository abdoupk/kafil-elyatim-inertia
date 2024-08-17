<script lang="ts" setup>
import type { FamiliesByOrphansCountType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

const BaseVerticalBarChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseVerticalBarChart.vue'))

defineProps<{
    familiesByOrphansCount: FamiliesByOrphansCountType
}>()
</script>

<template>
    <base-vertical-bar-chart
        :datasets
        :height="250"
        :labels="familiesByOrphansCount.orphans_count"
    ></base-vertical-bar-chart>
</template>
