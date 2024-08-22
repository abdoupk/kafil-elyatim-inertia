<script lang="ts" setup>
import type { OrphansByPantsAndShirtSizeType } from '@/types/statistics'

import BaseVerticalBarChart from '@/Components/Base/chart/BaseVerticalBarChart.vue'

import { __ } from '@/utils/i18n'

defineProps<{
    orphansByPantsAndShirtSize: OrphansByPantsAndShirtSizeType
}>()
</script>

<template>
    <base-vertical-bar-chart
        :datasets="[
            {
                data: orphansByPantsAndShirtSize.shirts_data,
                label: __('orphans_count')
            },
            {
                data: orphansByPantsAndShirtSize.pants_data,
                label: __('orphans_count')
            }
        ]"
        :height="300"
        :labels="Object.values(orphansByPantsAndShirtSize.labels)"
    ></base-vertical-bar-chart>
</template>
