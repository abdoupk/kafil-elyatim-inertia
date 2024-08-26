<script lang="ts" setup>
import type { ComingEventsType } from '@/types/dashboard'

import { computed, defineAsyncComponent } from 'vue'

import { formatDateAndTimeShort } from '@/utils/helper'

const TheExpandedCalendar = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/schedules/TheExpandedCalendar.vue')
)

const props = defineProps<{
    comingEvents: ComingEventsType
}>()

const events = props.comingEvents.map((attribute) => {
    return {
        dates: attribute.date,
        title: attribute.title
    }
})

const attributes = computed(() => [
    // Attributes for todos
    ...events.map((event) => ({
        dates: event.dates,
        highlight: {
            color: 'primary',
            fillMode: 'outline'
        },
        popover: {
            label: event.title
        }
    }))
])
</script>

<template>
    <suspense suspensible>
        <div class="intro-x box mt-5">
            <the-expanded-calendar :attributes class="px-1 py-2.5"></the-expanded-calendar>

            <div class="border-t border-slate-200/60 px-5 pb-5">
                <template v-if="comingEvents.length">
                    <div v-for="event in comingEvents" :key="event.id" class="mt-4 flex items-center first:mt-5">
                        <div
                            :style="{
                                'background-color': event.color
                            }"
                            class="me-3 h-2 w-2 rounded-full"
                        ></div>
                        <span class="truncate">{{ event.title }}</span
                        ><span class="ms-auto font-medium">{{ formatDateAndTimeShort(event.date) }}</span>
                    </div>
                </template>

                <div v-else class="mt-5 text-center">no schedules</div>
            </div>
        </div>
    </suspense>
</template>
