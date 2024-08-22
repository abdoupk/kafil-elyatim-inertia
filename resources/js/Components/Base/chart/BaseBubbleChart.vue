<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed } from 'vue'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'

const props = defineProps<{
    width?: number
    height?: number
    labels: string[] | number[]
    datasets: {
        label: string
        data: number[]
        backgroundColor?: () => string
    }[]
}>()

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const data = computed<ChartData>(() => {
    return {
        labels: props.labels,
        datasets: props.datasets.map((dataset, index) => {
            return {
                label: dataset.label,
                data: dataset.data
            }
        })
    }
})

const options = computed<ChartOptions>(() => {
    return {
        maintainAspectRatio: false
    }
})
</script>

<template>
    <base-chart :data :height :options :width type="bubble" />
</template>
