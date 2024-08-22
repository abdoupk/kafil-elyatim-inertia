<script lang="ts" setup>
import type { OrphansByAcademicLevelType } from '@/types/statistics'

import BaseVerticalBarChart from '@/Components/Base/chart/BaseVerticalBarChart.vue'

import { __ } from '@/utils/i18n'

defineProps<{
    orphansByAcademicLevel: OrphansByAcademicLevelType
}>()
</script>

<template>
    <base-vertical-bar-chart
        :datasets="[
            {
                data: orphansByAcademicLevel.data,
                label: __('orphans_count')
            }
        ]"
        :height="300"
        :labels="orphansByAcademicLevel.labels"
    ></base-vertical-bar-chart>
</template>
