<script lang="ts" setup>
import { computed } from 'vue'
import { ChartData, ChartOptions } from 'chart.js/auto'

import BaseChart from '@/Components/Base/chart/BaseChart.vue'
import { getColor } from '@/utils/colors'
import { useSettingsStore } from '@/stores/settings'

const props = defineProps<{
    width?: number;
    height?: number;
}>()

const colorScheme = computed(() => useSettingsStore().colorScheme)

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const data = computed<ChartData>(() => {
    return {
        labels: [
            'Jan',
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
            'Dec'
        ],
        datasets: [
            {
                label: '# of Votes',
                data: [0,
200,
250,
200,
700,
550,
650,
1050,
950,
1100,
900,
1200],
                borderWidth: 2,
                borderColor: colorScheme.value ? getColor('primary', 0.8) : '',

                backgroundColor: 'transparent',
                pointBorderColor: 'transparent',
                tension: 0.4
            },
            {
                label: '# of Votes',
                data: [0,
300,
400,
560,
320,
600,
720,
850,
690,
805,
1200,
1010],
                borderWidth: 2,
                borderDash: [2, 2],
                borderColor: darkMode.value
                    ? getColor('slate.400', 0.6)
                    : getColor('slate.400'),
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
                display: false
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
                    color: getColor('slate.500', 0.8),
                    callback: function(value) {
                        return '$' + value
                    }
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
    <base-chart
        :data="data"
        :height="props.height"
        :options="options"
        :width="props.width"
        type="line"
    />
</template>
