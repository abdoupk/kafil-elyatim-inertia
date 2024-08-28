<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed } from 'vue'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'

import { getColor } from '@/utils/colors'
import { getLocale } from '@/utils/i18n'

const props = defineProps<{
    width?: number
    height?: number
    lineColor?: string
    labels: string[]
    datasets: {
        label: string
        data: number[]
        borderColor: () => string
        backgroundColor: () => string
        pointBackgroundColor: () => string
        pointHoverBorderColor: () => string
    }[]
}>()

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

//TODO change pointBorderColor and pointHoverBackgroundColor
const data = computed<ChartData>(() => {
    return {
        labels: props.labels,
        datasets: props.datasets.map((dataset) => {
            return {
                label: dataset.label,
                data: dataset.data,
                fill: true,
                backgroundColor: dataset.backgroundColor(),
                borderColor: dataset.borderColor(),
                pointBackgroundColor: dataset.pointBackgroundColor(),
                pointBorderColor: darkMode.value ? getColor('slate.500', 0.3) : getColor('slate.300'),
                pointHoverBackgroundColor: darkMode.value ? getColor('slate.500', 0.3) : getColor('slate.300'),
                pointHoverBorderColor: dataset.pointHoverBorderColor()
            }
        })
    }
})

const options = computed<ChartOptions>(() => {
    return {
        elements: {
            line: {
                borderWidth: 3
            }
        },

        locale: getLocale()
    }
})
</script>

<template>
    <base-chart :data :height :options :width type="radar" />
</template>
