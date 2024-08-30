<script lang="ts" setup>
import type { OrphansByCreatedDateType } from '@/types/statistics'

import { useSettingsStore } from '@/stores/settings'
import { defineAsyncComponent } from 'vue'

import TheNoDataChart from '@/Components/Global/TheNoDataChart.vue'

import { getColor } from '@/utils/colors'
import { abbreviationMonths } from '@/utils/constants'
import { $t, getLocale } from '@/utils/i18n'

const BaseLineChart = defineAsyncComponent(() => import('@/Components/Base/chart/BaseLineChart.vue'))

defineProps<{
    orphansByCreatedDate: OrphansByCreatedDateType
}>()
</script>

<template>
    <suspense v-if="Object.values(orphansByCreatedDate).length" suspensible>
        <base-line-chart
            :datasets="[
                {
                    data: Object.values(orphansByCreatedDate),
                    label: $t('orphans_count'),
                    borderColor: () =>
                        useSettingsStore().appearance === 'dark' ? getColor('slate.300', 0.6) : getColor('primary', 0.8)
                }
            ]"
            :height="300"
            :labels="abbreviationMonths[getLocale()]"
        ></base-line-chart>
    </suspense>

    <the-no-data-chart v-else></the-no-data-chart>
</template>
