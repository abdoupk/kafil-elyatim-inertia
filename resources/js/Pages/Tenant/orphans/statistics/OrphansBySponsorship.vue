<script lang="ts" setup>
import type { OrphansBySponsorshipType } from '@/types/statistics'

import BasePolarBarChart from '@/Components/Base/chart/BasePolarBarChart.vue'

import { __ } from '@/utils/i18n'

defineProps<{
    orphansBySponsorship: OrphansBySponsorshipType
}>()
</script>

<template>
    <base-polar-bar-chart
        :chart-data="Object.values(orphansBySponsorship)"
        :labels="Object.keys(orphansBySponsorship).map((key) => __(key))"
    ></base-polar-bar-chart>
</template>
