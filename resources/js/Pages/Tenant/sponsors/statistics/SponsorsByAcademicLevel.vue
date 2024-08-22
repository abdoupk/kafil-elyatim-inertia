<script lang="ts" setup>
import type { SponsorsByAcademicLevelType } from '@/types/statistics'

import BaseVerticalBarChart from '@/Components/Base/chart/BaseVerticalBarChart.vue'

import { __ } from '@/utils/i18n'

defineProps<{
    sponsorsByAcademicLevel: SponsorsByAcademicLevelType
}>()
</script>

<template>
    <base-vertical-bar-chart
        :datasets="[
            {
                data: sponsorsByAcademicLevel.data,
                label: __('orphans_count')
            }
        ]"
        :height="300"
        :labels="sponsorsByAcademicLevel.labels"
    ></base-vertical-bar-chart>
</template>
