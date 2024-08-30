<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed } from 'vue'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'

import { getColor } from '@/utils/colors'
import { colorPalette } from '@/utils/constants'
import { getLocale } from '@/utils/i18n'

const props = defineProps<{
    width?: number
    height?: number
    labels: string[]
    chartData: number[]
}>()

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const colors = computed(() => {
    return colorPalette[darkMode.value ? 'dark' : 'light']
})

const data = computed<ChartData>(() => {
    return {
        labels: props.labels,
        datasets: [
            {
                data: props.chartData,
                backgroundColor: colors.value,
                borderWidth: 0,
                borderColor: darkMode.value ? getColor('darkmode.700') : getColor('white')
            }
        ]
    }
})

const options = computed<ChartOptions>(() => {
    return {
        maintainAspectRatio: false,

        plugins: {
            legend: {
                rtl: getLocale() === 'ar',
                labels: {
                    color: getColor('slate.500', 0.8)
                }
            },
            tooltip: {
                rtl: getLocale() === 'ar'
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
        },

        cutout: '65%',

        locale: getLocale()
    }
})
</script>

<template>
    <base-chart :data :height :options :width type="polarArea" />
</template>
