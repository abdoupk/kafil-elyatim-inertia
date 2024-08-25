<script lang="ts" setup>
import type { OrphansBySponsorshipType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { __ } from '@/utils/i18n'

const BasePolarBarChart = defineAsyncComponent(() => import('@/Components/Base/chart/BasePolarBarChart.vue'))

defineProps<{
    orphansBySponsorship: OrphansBySponsorshipType
}>()
</script>

<template>
    <suspense v-if="Object.values(orphansBySponsorship).length" suspensible>
        <base-polar-bar-chart
            :chart-data="Object.values(orphansBySponsorship)"
            :labels="Object.keys(orphansBySponsorship).map((key) => __(key))"
        ></base-polar-bar-chart>
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
