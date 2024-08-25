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

import { Head } from '@inertiajs/vue3'
import { defineAsyncComponent } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheGeneralReports from '@/Pages/Tenant/dashboard/general-reports/TheGeneralReports.vue'
import TheFamiliesOverview from '@/Pages/Tenant/dashboard/overview/families/TheFamiliesOverview.vue'
import TheNeedsOverview from '@/Pages/Tenant/dashboard/overview/needs/TheNeesdsOverview.vue'
import TheOrphansOverview from '@/Pages/Tenant/dashboard/overview/orphans/TheOrphansOverview.vue'

import TheContentLoader from '@/Components/Global/theContentLoader.vue'

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
    <Head :title="$t('home')" />

    <suspense>
        <template #default>
            <div>
                <!--Begin: General Reports-->
                <the-general-reports :reports></the-general-reports>
                <!--End: General Reports-->

                <!--Begin: Financial Reports-->
                <div class="grid grid-cols-12 gap-x-2">
                    <div class="col-span-12 mt-8 lg:col-span-6">
                        <div class="intro-y block h-10 items-center sm:flex">
                            <h2 class="me-5 truncate font-medium rtl:text-xl rtl:font-semibold">
                                {{ $t('statistics.dashboard.financial_report') }}
                            </h2>
                        </div>

                        <div class="intro-y box mt-12 p-5 sm:mt-5">
                            <suspense suspensible>
                                <the-financial-report :financialReports></the-financial-report>
                            </suspense>
                        </div>
                    </div>

                    <the-families-overview></the-families-overview>
                </div>
                <!--End: Financial Reports-->

                <!--Begin: Recent Families-->
                <div class="col-span-12 mt-6">
                    <div class="intro-y block h-10 items-center sm:flex">
                        <h2 class="me-5 truncate text-lg font-medium">{{ $t('Recent Added Families') }}</h2>
                    </div>

                    <suspense suspensible>
                        <the-recent-families :recentFamilies></the-recent-families>
                    </suspense>
                </div>
                <!--End: Recent Families-->

                <!--Begin: Overview-->
                <div class="col-span-12 mt-8 grid grid-cols-12 gap-6">
                    <the-needs-overview></the-needs-overview>

                    <the-orphans-overview></the-orphans-overview>
                </div>
                <!--End: Overview -->

                <div class="col-span-12 2xl:col-span-3">
                    <div class="-mb-10 pb-10 2xl:border-s">
                        <div class="grid grid-cols-12 gap-x-6 gap-y-6 2xl:gap-x-0 2xl:ps-6">
                            <!--Begin: Recent Financial Transaction-->
                            <div class="col-span-12 mt-3 md:col-span-6 xl:col-span-4 2xl:col-span-12 2xl:mt-8">
                                <div class="intro-x flex h-10 items-center">
                                    <h2 class="me-5 truncate text-lg font-medium">{{ $t('Transactions') }}</h2>
                                </div>
                                <suspense suspensible>
                                    <the-recent-financial-transactions
                                        :recentTransactions
                                    ></the-recent-financial-transactions>
                                </suspense>
                            </div>
                            <!--End: Recent Financial Transaction-->

                            <!--Begin: Recent Activities-->
                            <div class="col-span-12 mt-3 md:col-span-6 xl:col-span-4 2xl:col-span-12">
                                <div class="intro-x flex h-10 items-center">
                                    <h2 class="me-5 truncate text-lg font-medium">{{ $t('Recent Activities') }}</h2>
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
                                    <h2 class="me-5 truncate text-lg font-medium">{{ $t('Schedules') }}</h2>
                                </div>

                                <suspense suspensible>
                                    <the-schedules :comingEvents></the-schedules>
                                </suspense>
                            </div>
                            <!--End: Schedules-->

                            <!--Begin: Recent Needs-->
                            <div
                                class="col-span-12 mt-3 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto"
                            >
                                <suspense suspensible>
                                    <the-recent-needs :recentNeeds></the-recent-needs>
                                </suspense>
                            </div>
                            <!--End: Recent Needs-->
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #fallback>
            <the-content-loader class="!mt-24"></the-content-loader>
        </template>
    </suspense>
</template>
