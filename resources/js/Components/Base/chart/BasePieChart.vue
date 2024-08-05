<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed } from 'vue'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'

import { getColor } from '@/utils/colors'

const props = defineProps<{
    width?: number
    height?: number
    labels: string[]
    chartData: number[]
    chartColors: string[]
}>()

const colorScheme = computed(() => useSettingsStore().colorScheme)

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const data = computed<ChartData>(() => {
    return {
        labels: props.labels,
        datasets: [
            {
                data: props.chartData,
                backgroundColor: colorScheme.value ? props.chartColors : '',
                hoverBackgroundColor: colorScheme.value ? props.chartColors : '',
                borderWidth: 5,
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
                labels: {
                    color: getColor('slate.500', 0.8)
                }
            }
        }
    }
})
</script>

<template>
    <base-chart :data :height :options :width type="pie" />
</template>
