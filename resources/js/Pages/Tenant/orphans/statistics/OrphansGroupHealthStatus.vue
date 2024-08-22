<script lang="ts" setup>
import type { OrphansGroupHealthStatusType } from '@/types/statistics'

import BaseDonutChart from '@/Components/Base/chart/BaseDonutChart.vue'

defineProps<{
    orphansGroupHealthStatus: OrphansGroupHealthStatusType
}>()
</script>

<template>
    <base-donut-chart :chart-data="orphansGroupHealthStatus.data" :labels="orphansGroupHealthStatus.labels" />
</template>
