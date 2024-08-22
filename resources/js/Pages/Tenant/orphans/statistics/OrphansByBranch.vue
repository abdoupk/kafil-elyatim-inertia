<script lang="ts" setup>
import type { OrphansByBranchType } from '@/types/statistics'

import BasePieChart from '@/Components/Base/chart/BasePieChart.vue'

const props = defineProps<{
    orphansByBranch: OrphansByBranchType
}>()

console.log(props.orphansByBranch)
</script>

<template>
    <base-pie-chart :chart-data="orphansByBranch.data" :labels="orphansByBranch.label"></base-pie-chart>
</template>
