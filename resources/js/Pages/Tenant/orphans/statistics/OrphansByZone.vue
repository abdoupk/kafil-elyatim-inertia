<script lang="ts" setup>
import type { OrphansByZoneType } from '@/types/statistics'

import BasePolarBarChart from '@/Components/Base/chart/BasePolarBarChart.vue'

defineProps<{
    orphansByZone: OrphansByZoneType
}>()
</script>

<template>
    <base-polar-bar-chart :chart-data="orphansByZone.data" :labels="orphansByZone.labels"></base-polar-bar-chart>
</template>
