<script lang="ts" setup>
import type { ComingEventsType } from '@/types/dashboard'

import TheExpandedCalendar from '@/Pages/Tenant/dashboard/schedules/TheExpandedCalendar.vue'

import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{
    comingEvents: ComingEventsType
}>()
</script>

<template>
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

        <div class="intro-x box mt-5">
            <the-expanded-calendar class="px-1 py-2.5"></the-expanded-calendar>

            <div class="border-t border-slate-200/60 px-5 pb-5">
                <div class="mt-5 flex items-center">
                    <div class="me-3 h-2 w-2 rounded-full bg-pending"></div>
                    <span class="truncate">UI/UX Workshop</span><span class="font-medium xl:ms-auto">23th</span>
                </div>
                <div class="mt-4 flex items-center">
                    <div class="me-3 h-2 w-2 rounded-full bg-primary"></div>
                    <span class="truncate"> VueJs Frontend Development </span
                    ><span class="font-medium xl:ms-auto">10th</span>
                </div>
                <div class="mt-4 flex items-center">
                    <div class="me-3 h-2 w-2 rounded-full bg-warning"></div>
                    <span class="truncate">Laravel Rest API</span><span class="font-medium xl:ms-auto">31th</span>
                </div>
            </div>
        </div>
    </div>
</template>
