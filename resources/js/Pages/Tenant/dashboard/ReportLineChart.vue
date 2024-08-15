<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { ChartData, ChartOptions } from 'chart.js/auto'
import { computed } from 'vue'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'

import { getColor } from '@/utils/colors'
import { formatCurrency } from '@/utils/helper'
import { getLocale } from '@/utils/i18n'

const props = defineProps<{
    width?: number
    height?: number
    financialReports: {
        incomes: number[]
        expenses: number[]
    }
}>()

const colorScheme = computed(() => useSettingsStore().colorScheme)

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const data = computed<ChartData>(() => {
    return {
        labels: ['Jan',
'Feb',
'Mar',
'Apr',
'May',
'Jun',
'Jul',
'Aug',
'Sep',
'Oct',
'Nov',
'Dec'],
        datasets: [
            {
                label: '# of Votes',
                data: props.financialReports.incomes,
                borderWidth: 2,
                borderColor: colorScheme.value ? getColor('primary', 0.8) : '',

                backgroundColor: 'transparent',
                pointBorderColor: 'transparent',
                tension: 0.4
            },
            {
                label: '# of Votes',
                data: props.financialReports.expenses,
                borderWidth: 2,
                borderDash: [2, 2],
                borderColor: darkMode.value ? getColor('slate.400', 0.6) : getColor('slate.400'),
                backgroundColor: 'transparent',
                pointBorderColor: 'transparent',
                tension: 0.4
            }
        ]
    }
})

const options = computed<ChartOptions>(() => {
    return {
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
                rtl: getLocale() === 'ar'
            },
            tooltip: {
                rtl: getLocale() === 'ar'
            }
        },
        scales: {
            x: {
                reverse: getLocale() === 'ar',
                border: {
                    display: false
                },
                ticks: {
                    font: {
                        size: 12
                    },
                    color: getColor('slate.500', 0.8)
                },
                grid: {
                    display: false
                }
            },
            y: {
                border: {
                    display: false,
                    dash: [2, 2]
                },
                position: getLocale() === 'ar' ? 'right' : 'left',
                ticks: {
                    font: {
                        size: 12
                    },
                    color: getColor('slate.500', 0.8),
                    callback: function (value) {
                        return formatCurrency(value)
                    }
                },
                grid: {
                    drawTicks: false,
                    color: darkMode.value ? getColor('slate.500', 0.3) : getColor('slate.300')
                }
            }
        },

        locale: getLocale()
    }
})
</script>

<template>
    <base-chart :data="data" :height="props.height" :options="options" :width="props.width" type="line" />
</template>
