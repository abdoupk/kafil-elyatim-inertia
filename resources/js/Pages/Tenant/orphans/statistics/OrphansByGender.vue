<script lang="ts" setup>
import type { OrphansByGenderType } from '@/types/statistics'

import BaseDonutChart from '@/Components/Base/chart/BaseDonutChart.vue'

import { __ } from '@/utils/i18n'

defineProps<{
    orphansByGender: OrphansByGenderType
}>()
</script>

<template>
    <base-donut-chart
        :chart-data="orphansByGender.data"
        :labels="orphansByGender.labels.map((key) => __(key))"
    ></base-donut-chart>
</template>
