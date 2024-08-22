<script lang="ts" setup>
import type { OrphansBySponsorshipType } from '@/types/statistics'

import BasePolarBarChart from '@/Components/Base/chart/BasePolarBarChart.vue'

import { __ } from '@/utils/i18n'

const props = defineProps<{
    orphansBySponsorship: OrphansBySponsorshipType
}>()

console.log()
</script>

<template>
    <base-polar-bar-chart
        :chart-data="Object.values(props.orphansBySponsorship)"
        :labels="Object.keys(props.orphansBySponsorship).map((key) => __(key))"
    ></base-polar-bar-chart>
</template>
