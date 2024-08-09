<script lang="ts" setup>
import ReportLineChart from '@/Pages/Tenant/dashboard/ReportLineChart.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
</script>

<template>
    <div class="col-span-12 mt-8 lg:col-span-6">
        <div class="items-center block h-10 intro-y sm:flex">
            <h2 class="me-5 text-lg font-medium truncate">Sales Report</h2>
            <div class="relative mt-3 sm:ms-auto sm:mt-0 text-slate-500">
                <base-v-calendar></base-v-calendar>
            </div>
        </div>
        <div class="p-5 mt-12 intro-y box sm:mt-5">
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="flex">
                    <div>
                        <div class="text-lg font-medium text-primary dark:text-slate-300 xl:text-xl">$15,000</div>
                        <div class="mt-0.5 text-slate-500">This Month</div>
                    </div>
                    <div
                        class="w-px h-12 mx-4 border border-e border-dashed border-slate-200 dark:border-darkmode-300 xl:mx-5"
                    ></div>
                    <div>
                        <div class="text-lg font-medium text-slate-500 xl:text-xl">$10,000</div>
                        <div class="mt-0.5 text-slate-500">Last Month</div>
                    </div>
                </div>
            </div>
            <div
                :class="[
                    'relative',
                    'before:content-[\'\'] before:block before:absolute before:w-16 before:start-0 before:top-0 before:bottom-0 before:ms-10 before:mb-7 before:bg-gradient-to-e before:from-white before:via-white/80 before:to-transparent before:dark:from-darkmode-600',
                    'after:content-[\'\'] after:block after:absolute after:w-16 after:end-0 after:top-0 after:bottom-0 after:mb-7 after:bg-gradient-to-s after:from-white after:via-white/80 after:to-transparent after:dark:from-darkmode-600'
                ]"
            >
                <ReportLineChart :height="275" class="mt-6 -mb-6" />
            </div>
        </div>
    </div>
</template>
