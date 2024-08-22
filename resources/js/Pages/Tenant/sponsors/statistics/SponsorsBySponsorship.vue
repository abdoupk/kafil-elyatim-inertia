<script lang="ts" setup>
import type { SponsorsBySponsorshipType } from '@/types/statistics'

import BasePolarBarChart from '@/Components/Base/chart/BasePolarBarChart.vue'

import { __ } from '@/utils/i18n'

const props = defineProps<{
    sponsorsBySponsorship: SponsorsBySponsorshipType
}>()
</script>

<template>
    <base-polar-bar-chart
        :chart-data="Object.values(sponsorsBySponsorship)"
        :labels="Object.keys(sponsorsBySponsorship).map((key) => __(key))"
    ></base-polar-bar-chart>
</template>
