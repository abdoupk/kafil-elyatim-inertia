<script lang="ts" setup>
import type {
    FamiliesByBranchType,
    FamiliesByOrphansCountType,
    FamiliesByZoneType,
    FamiliesGroupByDateType,
    FamiliesSponsorShipsType
} from '@/types/statistics'

import { Head } from '@inertiajs/vue3'
import { defineAsyncComponent } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheStatisticBox from '@/Components/Global/TheStatisticBox.vue'

const FamiliesByBranch = defineAsyncComponent(() => import('@/Pages/Tenant/families/statistics/FamiliesByBranch.vue'))

const FamiliesByOrphansCount = defineAsyncComponent(
    () => import('@/Pages/Tenant/families/statistics/FamiliesByOrphansCount.vue')
)

const FamiliesBySponsorShip = defineAsyncComponent(
    () => import('@/Pages/Tenant/families/statistics/FamiliesBySponsorShip.vue')
)

const FamiliesByStartDateYear = defineAsyncComponent(
    () => import('@/Pages/Tenant/families/statistics/FamiliesByStartDateYear.vue')
)

const FamiliesByZone = defineAsyncComponent(() => import('@/Pages/Tenant/families/statistics/FamiliesByZone.vue'))

defineOptions({
    layout: TheLayout
})

defineProps<{
    familiesByZone: FamiliesByZoneType
    familiesByBranch: FamiliesByBranchType
    familiesByOrphansCount: FamiliesByOrphansCountType
    familiesSponsorShips: FamiliesSponsorShipsType
    familiesGroupByDate: FamiliesGroupByDateType
}>()
</script>

<template>
    <Head :title="$t('statistics', { attribute: $t('the_families') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">ljlkjlkjl</h2>

    <div class="intro-y mt-5 grid grid-cols-12 gap-6">
        <!-- Begin: familiesByZone -->
        <div class="col-span-12 lg:col-span-6">
            <the-statistic-box>
                <template #title> title</template>

                <template #chart>
                    <suspense>
                        <families-by-zone :familiesByZone></families-by-zone>
                    </suspense>
                </template>
            </the-statistic-box>
        </div>
        <!-- End: familiesByZone -->

        <!-- Begin: familiesByBranch -->
        <div class="col-span-12 lg:col-span-6">
            <the-statistic-box>
                <template #title> title</template>

                <template #chart>
                    <suspense>
                        <families-by-branch :familiesByBranch></families-by-branch>
                    </suspense>
                </template>
            </the-statistic-box>
        </div>
        <!-- End: familiesByBranch -->

        <!-- Begin: familiesByOrphansCount -->
        <div class="col-span-12 lg:col-span-6">
            <the-statistic-box>
                <template #title> title</template>

                <template #chart>
                    <suspense>
                        <families-by-orphans-count :familiesByOrphansCount></families-by-orphans-count>
                    </suspense>
                </template>
            </the-statistic-box>
        </div>
        <!-- End: familiesByOrphansCount -->

        <!-- Begin: Sponsorships -->
        <div class="col-span-12 lg:col-span-6">
            <the-statistic-box>
                <template #title> title</template>

                <template #chart>
                    <suspense>
                        <families-by-sponsor-ship :familiesSponsorShips></families-by-sponsor-ship>
                    </suspense>
                </template>
            </the-statistic-box>
        </div>
        <!-- End: Sponsorships -->

        <!-- Begin: Start Date -->
        <div class="col-span-12 lg:col-span-6">
            <the-statistic-box>
                <template #title> title</template>

                <template #chart>
                    <suspense>
                        <families-by-start-date-year :familiesGroupByDate></families-by-start-date-year>
                    </suspense>
                </template>
            </the-statistic-box>
        </div>
        <!-- End: Start Date -->
    </div>
</template>
