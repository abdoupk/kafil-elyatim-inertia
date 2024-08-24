<script lang="ts" setup>
import type { FamiliesSponsorShipsType } from '@/types/statistics'

import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed } from 'vue'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'

import { getColor } from '@/utils/colors'
import { __ } from '@/utils/i18n'

const props = defineProps<{
    familiesSponsorShips: FamiliesSponsorShipsType
}>()

const labels = [
    __('sponsorships.ramadan_basket'),
    __('sponsorships.zakat'),
    __('sponsorships.housing_assistance'),
    __('sponsorships.eid_al_adha')
]

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const data = computed<ChartData>(() => {
    return {
        labels,
        datasets: [
            {
                label: __('statistics.families.titles.families_by_sponsorships'),
                data: Object.values(props.familiesSponsorShips)
            }
        ]
    }
})

const options = computed<ChartOptions>(() => {
    return {
        elements: {
            line: {
                borderWidth: 2
            }
        },
        scales: {
            r: {
                suggestedMin: 0,
                grid: {
                    tickColor: 'rgba(255, 255, 255, 0.0)',
                    color: !darkMode.value ? getColor('slate.500', 0.3) : getColor('slate.400', 0.8)
                },
                ticks: {
                    font: {
                        size: 12
                    },
                    color: darkMode.value ? getColor('slate.300', 0.8) : getColor('slate.600', 0.8),
                    backdropColor: 'rgba(255, 255, 255, 0.0)'
                }
            }
        }
    }
})
</script>

<template>
    <suspense>
        <div class="flex items-center justify-center">
            <base-chart :data :height="400" :options :width="400" type="radar" />
        </div>
    </suspense>
</template>
