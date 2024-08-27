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
    data: number[]
}>()

const colorScheme = computed(() => useSettingsStore().colorScheme)

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const chartColors = () => [getColor('primary', 0.9), getColor('warning', 0.9)]

const data = computed<ChartData>(() => {
    return {
        labels: props.labels,
        datasets: [
            {
                data: props.data,
                backgroundColor: colorScheme.value ? chartColors() : '',
                hoverBackgroundColor: colorScheme.value ? chartColors() : '',
                borderWidth: 2,
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
                display: false
            }
        },
        cutout: '83%'
    }
})
</script>

<template>
    <base-chart :data :height :options :width type="doughnut" />
</template>
