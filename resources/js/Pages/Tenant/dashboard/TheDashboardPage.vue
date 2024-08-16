<script lang="ts" setup>
import type { GeneralReports } from '@/types/dashboard'

import { Head } from '@inertiajs/vue3'
import { defineAsyncComponent } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheGeneralReports from '@/Pages/Tenant/dashboard/general-reports/TheGeneralReports.vue'
import TheRecentActivities from '@/Pages/Tenant/dashboard/recent-activities/TheRecentActivities.vue'
import TheRecentFamilies from '@/Pages/Tenant/dashboard/recent-families/TheRecentFamilies.vue'
import TheSchedules from '@/Pages/Tenant/dashboard/schedules/TheSchedules.vue'
import TheRecentFinancialTransactions from '@/Pages/Tenant/dashboard/transactions/TheRecentFinancialTransactions.vue'

const TheFinancialReport = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/financial-report/TheFinancialReport.vue')
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

        weekly radar financial
    </div>
    <the-recent-families></the-recent-families>
    <div class="col-span-12 2xl:col-span-3">
        <div class="-mb-10 pb-10 2xl:border-l">
            <div class="grid grid-cols-12 gap-x-6 gap-y-6 2xl:gap-x-0 2xl:pl-6">
                <the-recent-activities></the-recent-activities>

                <the-schedules></the-schedules>

                <the-recent-financial-transactions></the-recent-financial-transactions>
            </div>
        </div>
    </div>
</template>
