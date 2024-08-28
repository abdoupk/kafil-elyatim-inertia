<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed } from 'vue'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'

import { getColor } from '@/utils/colors'
import { colorPalette } from '@/utils/constants'
import { addOpacityToHexColors } from '@/utils/helper'
import { getLocale } from '@/utils/i18n'

const props = defineProps<{
    width?: number
    height?: number
    labels: string[]
    chartData: number[]
}>()

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const palette = colorPalette[darkMode.value ? 'dark' : 'light'].sort(() => Math.random() - 0.5)

const colors = computed(() => {
    return {
        backgroundColor: palette,
        hoverBackgroundColor: addOpacityToHexColors(palette, 0.7)
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

        cutout: '65%',

        locale: getLocale()
    }
})
</script>

<template>
    <base-chart :data :height :options :width type="polarArea" />
</template>
