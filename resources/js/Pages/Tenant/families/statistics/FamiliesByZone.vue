<script lang="ts" setup>
import type { FamiliesByZoneType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

const BasePieChart = defineAsyncComponent(() => import('@/Components/Base/chart/BasePieChart.vue'))

defineProps<{
    familiesByZone: FamiliesByZoneType
}>()
</script>

<template>
    <suspense>
        <base-pie-chart :chart-data="familiesByZone.data" :labels="familiesByZone.labels"></base-pie-chart>
    </suspense>
</template>
