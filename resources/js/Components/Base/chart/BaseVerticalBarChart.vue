<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed } from 'vue'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'

import { getColor } from '@/utils/colors'

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
        datasets: props.datasets.map((dataset) => {
            return {
                label: dataset.label,
                data: dataset.data,
                backgroundColor: darkMode.value ? getColor('sky.500', 0.6) : getColor('primary', 0.7)
            }
        })
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
        },
        scales: {
            x: {
                ticks: {
                    font: {
                        size: 12
                    },
                    color: getColor('slate.500', 0.8)
                },
                grid: {
                    display: false,
                    drawBorder: false
                }
            },
            y: {
                ticks: {
                    font: {
                        size: 12
                    },
                    color: getColor('slate.500', 0.8)
                },
                grid: {
                    color: darkMode.value ? getColor('slate.500', 0.3) : getColor('slate.300'),
                    borderDash: [2, 2],
                    drawBorder: false
                }
            }
        }
    }
})
</script>

<template>
    <base-chart :data :height :options :width type="bar" />
</template>
