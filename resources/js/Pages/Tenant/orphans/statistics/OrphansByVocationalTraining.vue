<script lang="ts" setup>
import type { OrphansByVocationalTrainingType } from '@/types/statistics'

import BaseVerticalBarChart from '@/Components/Base/chart/BaseVerticalBarChart.vue'

import { __ } from '@/utils/i18n'

defineProps<{
    orphansByVocationalTraining: OrphansByVocationalTrainingType
}>()
</script>

<template>
    <base-vertical-bar-chart
        :datasets="[
            {
                data: orphansByVocationalTraining.data,
                label: __('orphans_count')
            }
        ]"
        :height="300"
        :labels="orphansByVocationalTraining.labels"
    ></base-vertical-bar-chart>
</template>
