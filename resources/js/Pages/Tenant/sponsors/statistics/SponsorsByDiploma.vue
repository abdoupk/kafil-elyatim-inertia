<script lang="ts" setup>
import type { SponsorsByDiplomaType } from '@/types/statistics'

import BaseDonutChart from '@/Components/Base/chart/BaseDonutChart.vue'

defineProps<{
    sponsorsByDiploma: SponsorsByDiplomaType
}>()
</script>

<template>
    <base-donut-chart :chart-data="sponsorsByDiploma.data" :labels="sponsorsByDiploma.labels"></base-donut-chart>
</template>
