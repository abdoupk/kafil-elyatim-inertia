<script lang="ts" setup>
import type { SponsorsBySponsorTypeType } from '@/types/statistics'

import BaseVerticalBarChart from '@/Components/Base/chart/BaseVerticalBarChart.vue'

defineProps<{
    sponsorsBySponsorType: SponsorsBySponsorTypeType
}>()
</script>

<template>
    <base-vertical-bar-chart
        :datasets="[
            {
                data: sponsorsBySponsorType.data,
                label: '54545454'
            }
        ]"
        :height="300"
        :labels="sponsorsBySponsorType.labels"
    ></base-vertical-bar-chart>
</template>
