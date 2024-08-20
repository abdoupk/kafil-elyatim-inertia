<script lang="ts" setup>
import type {
    ComingEventsType,
    FinancialReportsType,
    GeneralReportsType,
    RecentActivitiesType,
    RecentFamiliesType,
    RecentNeedsType,
    RecentTransactionsType
} from '@/types/dashboard'

import { Head, Link } from '@inertiajs/vue3'
import { defineAsyncComponent } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheGeneralReports from '@/Pages/Tenant/dashboard/general-reports/TheGeneralReports.vue'

import TheChartLoader from '@/Components/Global/TheChartLoader.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const TheRecentNeeds = defineAsyncComponent(() => import('@/Pages/Tenant/dashboard/needs/TheRecentNeeds.vue'))

const TheRecentActivities = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/recent-activities/TheRecentActivities.vue')
)

const TheRecentFamilies = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/recent-families/TheRecentFamilies.vue')
)

const TheSchedules = defineAsyncComponent(() => import('@/Pages/Tenant/dashboard/schedules/TheSchedules.vue'))

const TheRecentFinancialTransactions = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/transactions/TheRecentFinancialTransactions.vue')
)

const TheFinancialReport = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/financial-report/TheFinancialReport.vue')
)

defineOptions({
    layout: TheLayout
})

defineProps<{
    reports: GeneralReportsType
    financialReports: FinancialReportsType
    recentActivities: RecentActivitiesType
    recentTransactions: RecentTransactionsType
    comingEvents: ComingEventsType
    recentFamilies: RecentFamiliesType
    recentNeeds: RecentNeedsType
}>()
</script>

<template>
    <Head title="Dashboard" />
    <!--Begin: General Reports-->
    <the-general-reports :reports></the-general-reports>
    <!--End: General Reports-->

    <!--Begin: Financial Reports-->
    <div class="grid grid-cols-12">
        <div class="col-span-12 mt-8 lg:col-span-8">
            <div class="intro-y block h-10 items-center sm:flex">
                <h2 class="me-5 truncate font-medium rtl:text-xl rtl:font-semibold">
                    {{ $t('statistics.dashboard.financial_report') }}
                </h2>
            </div>

            <div class="intro-y box mt-12 p-5 sm:mt-5">
                <suspense suspensible>
                    <template #default>
                        <the-financial-report :financialReports></the-financial-report>
                    </template>

                    <template #fallback>
                        <the-chart-loader></the-chart-loader>
                    </template>
                </suspense>
            </div>
        </div>

        <!--        weekly radar financial-->
    </div>
    <!--End: Financial Reports-->

    <!--Begin: Recent Families-->
    <div class="col-span-12 mt-6">
        <div class="intro-y block h-10 items-center sm:flex">
            <h2 class="me-5 truncate text-lg font-medium">Recent Added Families</h2>
        </div>

        <suspense suspensible>
            <the-recent-families :recentFamilies></the-recent-families>

            <template #fallback>
                <the-chart-loader></the-chart-loader>
            </template>
        </suspense>
    </div>
    <!--End: Recent Families-->

    <div class="col-span-12 2xl:col-span-3">
        <div class="-mb-10 pb-10 2xl:border-s">
            <div class="grid grid-cols-12 gap-x-6 gap-y-6 2xl:gap-x-0 2xl:ps-6">
                <!--Begin: Recent Financial Transaction-->
                <div class="col-span-12 mt-3 md:col-span-6 xl:col-span-4 2xl:col-span-12 2xl:mt-8">
                    <div class="intro-x flex h-10 items-center">
                        <h2 class="me-5 truncate text-lg font-medium">Transactions</h2>
                    </div>
                    <suspense suspensible>
                        <the-recent-financial-transactions :recentTransactions></the-recent-financial-transactions>
                    </suspense>
                </div>
                <!--End: Recent Financial Transaction-->

                <!--Begin: Recent Activities-->
                <div class="col-span-12 mt-3 md:col-span-6 xl:col-span-4 2xl:col-span-12">
                    <div class="intro-x flex h-10 items-center">
                        <h2 class="me-5 truncate text-lg font-medium">Recent Activities</h2>

                        <Link :href="route('tenant.dashboard')" class="ms-auto truncate text-primary"> Show More</Link>
                    </div>
                    <suspense suspensible>
                        <the-recent-activities :recentActivities></the-recent-activities>

                        <template #fallback>loader</template>
                    </suspense>
                </div>
                <!--End: Recent Activities-->

                <!--Begin: Schedules-->
                <div
                    class="col-span-12 mt-3 md:col-span-6 xl:col-span-4 xl:col-start-1 xl:row-start-2 2xl:col-span-12 2xl:col-start-auto 2xl:row-start-auto"
                >
                    <div class="intro-x flex h-10 items-center">
                        <h2 class="me-5 truncate text-lg font-medium">Schedules</h2>
                        <a class="ms-auto flex items-center truncate text-primary" href="">
                            <svg-loader class="me-1 h-4 w-4" name="icon-plus"></svg-loader>

                            Add New Schedules
                        </a>
                    </div>

                    <suspense suspensible>
                        <the-schedules :comingEvents></the-schedules>

                        <template #fallback>
                            <div class="">54646546546464</div>
                        </template>
                    </suspense>
                </div>
                <!--End: Schedules-->

                <!--Begin: Recent Needs-->
                <div
                    class="col-span-12 mt-3 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto"
                >
                    <suspense suspensible>
                        <the-recent-needs :recentNeeds></the-recent-needs>

                        <template #fallback>
                            <the-chart-loader></the-chart-loader>
                        </template>
                    </suspense>
                </div>
                <!--End: Recent Needs-->
            </div>
        </div>
    </div>
</template>
