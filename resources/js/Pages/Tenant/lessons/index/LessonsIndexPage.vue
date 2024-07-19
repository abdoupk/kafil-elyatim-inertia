<script lang="ts" setup>
import type { EventType, OrphanType, SchoolType, SubjectType } from '@/types/lessons'

import { useLessonsStore } from '@/stores/lessons'
import { type EventApi } from '@fullcalendar/core'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import LessonCreateModal from '@/Pages/Tenant/lessons/create/LessonCreateModal.vue'
import LessonActionsModal from '@/Pages/Tenant/lessons/index/LessonActionsModal.vue'

import BaseCalendar from '@/Components/Base/calendar/BaseCalendar.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{ orphans: OrphanType[]; schools: SchoolType[]; subjects: SubjectType[]; events: EventType[] }>()

const createModalStatus = ref(false)

const date = ref('')

const actionsModalStatus = ref(false)

const lessonsStore = useLessonsStore()

const openCreateModal = (args: { dateStr: string }) => {
    date.value = args.dateStr

    lessonsStore.$reset()

    createModalStatus.value = true
}

const handleEventChange = (event: EventApi) => {
    const { id, startStr, endStr } = event

    lessonsStore
        .updateLesson(id, {
            start_date: startStr,
            end_date: endStr
        })
        .then(() => {
            console.log('success')
        })
}

const HandleEventClick = (event: EventApi) => {
    actionsModalStatus.value = true
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_members') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_members') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center">
            <base-calendar
                :events
                class="w-full"
                @event-click="HandleEventClick"
                @date-click="openCreateModal"
                @event-drop="handleEventChange"
                @event-resize="handleEventChange"
            ></base-calendar>
        </div>
    </div>

    <lesson-create-modal
        :date
        :open="createModalStatus"
        :orphans
        :schools
        :subjects
        @close="createModalStatus = false"
    ></lesson-create-modal>

    <lesson-actions-modal :open="actionsModalStatus" @close="actionsModalStatus = false"></lesson-actions-modal>
</template>
