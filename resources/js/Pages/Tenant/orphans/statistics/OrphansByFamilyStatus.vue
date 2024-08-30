<script lang="ts" setup>
import type { OrphansByFamilyStatusType } from '@/types/statistics'

import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed, defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { getColor } from '@/utils/colors'
import { $t } from '@/utils/i18n'

const BaseChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseChart.vue'))

const props = defineProps<{
    orphansByFamilyStatus: OrphansByFamilyStatusType
}>()

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const data = computed<ChartData>(() => {
    return {
        labels: props.orphansByFamilyStatus.labels,
        datasets: [
            {
                label: $t('statistics.orphans.titles.orphans_by_family_status'),
                backgroundColor: getColor('primary', 0.4),
                pointBackgroundColor: getColor('primary', 0.5),
                pointHoverBorderColor: getColor('primary', 0.7),
                pointHoverBackgroundColor: getColor('white'),
                data: props.orphansByFamilyStatus.data
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
                    backdropColor: 'rgba(255, 255, 255, 0.0)',
                    callback(tickValue: number) {
                        if (tickValue % 1 === 0) {
                            return tickValue
                        }
                    }
                }
            }
        }
    }
})
</script>

<template>
    <suspense v-if="data.datasets[0].data.length" suspensible>
        <div class="flex items-center justify-center">
            <base-chart :data :height="400" :options :width="400" type="radar" />
        </div>
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
