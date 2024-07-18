<script lang="ts" setup>
import TheLayout from '@/Layouts/TheLayout.vue'
import BaseCalendar from '@/Components/Base/calendar/BaseCalendar.vue'
import { Head } from '@inertiajs/vue3'
import LessonCreateModal from '@/Pages/Tenant/lessons/LessonCreateModal.vue'
import { ref } from 'vue'
import { useLessonsStore } from '@/stores/lessons'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{ orphans: any[], schools: any[], subjects: any[], events: any }>()

console.log(props)

const createModalStatus = ref(false)

const date = ref('')

const lessonsStore = useLessonsStore()

const openCreateModal = (args) => {
    date.value = args.dateStr

    lessonsStore.$reset()

    lessonsStore.lesson.start_date = date.value

    createModalStatus.value = true
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_members') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_members') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center">
            <base-calendar :events class="w-full" @date-click="openCreateModal"></base-calendar>
        </div>
    </div>

    <lesson-create-modal :date :open="createModalStatus" :orphans :schools
                         :subjects @close="createModalStatus = false"></lesson-create-modal>
</template>
