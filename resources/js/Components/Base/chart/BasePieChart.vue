<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed, defineAsyncComponent } from 'vue'

import { getColor } from '@/utils/colors'
import { colorPalette } from '@/utils/constants'
import { getLocale } from '@/utils/i18n'

const BaseChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseChart.vue'))

const props = defineProps<{
    width?: number
    height?: number
    labels: string[]
    chartData: number[]
}>()

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const colors = computed(() => {
    return {
        backgroundColor: colorPalette[darkMode.value ? 'dark' : 'light'],
        hoverBackgroundColor: colorPalette[darkMode.value ? 'dark' : 'light']
    }
})

const data = computed<ChartData>(() => {
    return {
        labels: props.labels,
        datasets: [
            {
                data: props.chartData,
                backgroundColor: colors.value.backgroundColor,
                hoverBackgroundColor: colors.value.hoverBackgroundColor,
                borderWidth: 3,
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
                },
                rtl: getLocale() === 'ar'
            },
            tooltip: {
                rtl: getLocale() === 'ar'
            }
        },

        locale: getLocale()
    }
})
</script>

<template>
    <base-chart :data :height :options :width type="pie" />
</template>
