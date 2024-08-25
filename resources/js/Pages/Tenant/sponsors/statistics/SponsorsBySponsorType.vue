<script lang="ts" setup>
import type { SponsorsBySponsorTypeType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

const BaseVerticalBarChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseVerticalBarChart.vue'))

defineProps<{
    sponsorsBySponsorType: SponsorsBySponsorTypeType
}>()
</script>

<template>
    <suspense v-if="sponsorsBySponsorType.data.length" suspensible>
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
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
