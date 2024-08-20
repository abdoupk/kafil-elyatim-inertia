<script lang="ts" setup>
import type { ComingEventsType } from '@/types/dashboard'

import { defineAsyncComponent } from 'vue'

const TheExpandedCalendar = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/schedules/TheExpandedCalendar.vue')
)

defineProps<{
    comingEvents: ComingEventsType
}>()
</script>

<template>
    <suspense suspensible>
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
    </suspense>
</template>
