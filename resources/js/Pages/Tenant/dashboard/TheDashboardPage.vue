<script lang="ts" setup>
import type { GeneralReports } from '@/types/dashboard'

import { useSettingsStore } from '@/stores/settings'
import { Head } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheFinancialReport from '@/Pages/Tenant/dashboard/FinianchialReport/TheFinancialReport.vue'
import TheGeneralReports from '@/Pages/Tenant/dashboard/GenralReports/TheGeneralReports.vue'
import TestCombo from '@/Pages/Tenant/dashboard/TestCombo.vue'

import { getColor } from '@/utils/colors'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    reports: GeneralReports
    financialReports: {
        incomes: number[]
        expenses: number[]
    }
}>()

console.log(props)

const colorScheme = computed(() => useSettingsStore().colorScheme)

const darkMode = computed(() => useSettingsStore().appearance === 'dark')

const datasets = ref([
    {
        // eslint-disable-next-line array-element-newline
        data: props.financialReports.incomes,
        label: 'Incomes',
        borderColor: () => (colorScheme.value ? getColor('primary') : '')
    },
    {
        // eslint-disable-next-line array-element-newline
        data: props.financialReports.expenses,
        label: 'Expenses',
        borderColor: () => (darkMode.value ? getColor('darkmode.200') : getColor('slate.300'))
    }
])

// eslint-disable-next-line array-element-newline
const labels = ref(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'May', 'Jun', 'Jul', 'Aug'])
</script>

<template>
    <Head title="Dashboard" />

    <div class="col-span-12 mt-5 w-1/2">
        <test-combo></test-combo>
    </div>

    <the-general-reports :reports></the-general-reports>

    <div class="co col-span-12 grid">
        <the-financial-report></the-financial-report>
    </div>
</template>
