<script lang="ts" setup>
import type { GeneralReports } from '@/types/dashboard'

import { Head } from '@inertiajs/vue3'
import { defineAsyncComponent } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheGeneralReports from '@/Pages/Tenant/dashboard/GeneralReports/TheGeneralReports.vue'

const TheFinancialReport = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/FinancialReport/TheFinancialReport.vue')
)

defineOptions({
    layout: TheLayout
})

defineProps<{
    reports: GeneralReports
    financialReports: {
        incomes: number[]
        expenses: number[]
        totalThisMonth: number
        totalLastMonth: number
    }
}>()
</script>

<template>
    <Head title="Dashboard" />

    <the-general-reports :reports></the-general-reports>

    <div class="grid grid-cols-12">
        <div class="col-span-12 mt-8 lg:col-span-8">
            <suspense>
                <template #default>
                    <the-financial-report :financialReports></the-financial-report>
                </template>
            </suspense>
        </div>
    </div>
</template>
