<script lang="ts" setup>
import type { OrphansByAcademicLevelType } from '@/types/statistics'

import { useSettingsStore } from '@/stores/settings'
import { computed } from 'vue'

import BaseVerticalBarChart from '@/Components/Base/chart/BaseVerticalBarChart.vue'

import { __ } from '@/utils/i18n'

const props = defineProps<{
    orphansByAcademicLevel: OrphansByAcademicLevelType
}>()

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const datasets = [
    {
        data: props.orphansByAcademicLevel.data,
        label: __('orphans_count')
    }
]
</script>

<template>
    <base-vertical-bar-chart
        :datasets
        :height="280"
        :labels="props.orphansByAcademicLevel.labels"
    ></base-vertical-bar-chart>
</template>
