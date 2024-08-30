<script lang="ts" setup>
import type { FamiliesSponsorShipsType } from '@/types/statistics'

import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { __ } from '@/utils/i18n'

const BaseRadarChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseRadarChart.vue'))

const props = defineProps<{
    familiesSponsorShips: FamiliesSponsorShipsType
}>()

const labels = [
    __('sponsorships.ramadan_basket'),
    __('sponsorships.zakat'),
    __('sponsorships.housing_assistance'),
    __('sponsorships.eid_al_adha')
]

const datasets = [
    {
        label: __('sponsorship_type'),
        data: Object.values(props.familiesSponsorShips)
    }
]
</script>

<template>
    <suspense v-if="datasets[0].data.length" suspensible>
        <div class="flex items-center justify-center">
            <base-radar-chart :datasets :height="400" :labels :width="400" />
        </div>
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
