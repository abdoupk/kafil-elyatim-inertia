<script lang="ts" setup>
import type { FamiliesByOrphansCountType } from '@/types/statistics'

import { useSettingsStore } from '@/stores/settings'
import type { ChartData, ChartOptions } from 'chart.js/auto'
import { computed, defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { getColor } from '@/utils/colors'
import { __, n__ } from '@/utils/i18n'

const BaseChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseChart.vue'))

const props = defineProps<{
    familiesByOrphansCount: FamiliesByOrphansCountType
}>()

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const data = computed<ChartData>(() => {
    return {
        labels: props.familiesByOrphansCount.orphans_count.map((orphan) =>
            n__('statistics.families.labels.orphans_count', orphan, {
                value: orphan
            })
        ),
        datasets: [
            {
                label: __('families_count'),
                data: props.familiesByOrphansCount.total_families
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
                    callback: function (value: number) {
                        if (value % 1 === 0) {
                            return value
                        }
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
    <suspense v-if="data.datasets[0].data.length" suspensible>
        <base-chart :data :height="270" :options type="bar" />
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
