<script lang="ts" setup>
/* eslint-disable vue/no-parsing-error */
import type { AcademicLevelType, SubjectType } from '@/types/lessons'

import { useSchoolsStore } from '@/stores/schools'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'
import TheSubjectAndQuota from '@/Pages/Tenant/schools/create/TheSubjectAndQuota.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { __, n__ } from '@/utils/i18n'

defineProps<{
    open: boolean
    subjects: SubjectType[]
    academicLevels: AcademicLevelType[]
}>()

// Get the schools store
const schoolsStore = useSchoolsStore()

// Initialize a ref for loading state
const loading = ref(false)

const form = computed(() => {
    if (schoolsStore.school.id) {
        return useForm('put', route('tenant.schools.update', schoolsStore.school.id), { ...schoolsStore.school })
    }

    return useForm('post', route('tenant.schools.store'), { ...schoolsStore.school })
})

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])

// Function to handle success and close the slideover after a delay
const handleSuccess = () => {
    setTimeout(() => {
        router.get(
            route('tenant.schools.index'),
            {},
            {
                only: ['schools'],
                preserveState: true
            }
        )
    }, 200)

    emit('close')
}

// Function to handle form submission
const handleSubmit = async () => {
    loading.value = true

    try {
        await form.value.submit().then(handleSuccess)
    } finally {
        loading.value = false
    }
}

// Compute the slideover title based on the school id
const modalTitle = computed(() => {
    return schoolsStore.school.id ? __('update school') : n__('add new', 0, { attribute: __('school') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the school id
const modalType = computed(() => {
    return schoolsStore.school.id ? 'update' : 'create'
})

const addLesson = () => {
    form.value.lessons.push({
        academic_level_id: null,
        quota: null,
        subject_id: null
    })
}

const removeLesson = (index: number) => {
    if (index === 0) return

    form.value.lessons.splice(index, 1)
}
</script>

<template>
    <create-edit-modal
        :focusable-input="firstInputRef"
        :loading
        :modal-type="modalType"
        :open
        :title="modalTitle"
        size="xl"
        @close="emit('close')"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <!-- Begin: Name-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="name">
                    {{ $t('school_name') }}
                </base-form-label>

                <base-form-input
                    id="name"
                    ref="firstInputRef"
                    v-model="form.name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('school_name') })"
                    type="text"
                    @change="form.validate('name')"
                />

                <div v-if="form.errors?.name" class="mt-2">
                    <base-input-error :message="form.errors.name"></base-input-error>
                </div>
            </div>
            <!-- End: Name-->

            <the-subject-and-quota
                v-for="(lesson, index) in form.lessons"
                :key="index"
                v-model:academic-level="lesson.academic_level_id"
                v-model:quota="lesson.quota"
                v-model:subject="lesson.subject_id"
                :academicLevels
                :form
                :index
                :subjects
                @remove-lesson="removeLesson(index)"
            ></the-subject-and-quota>

            <div class="flex items-center justify-center col-span-12">
                <base-button
                    class="mx-auto mt-3 block w-1/2 border-dashed dark:text-slate-500"
                    data-test="add_phone_number"
                    type="button"
                    variant="outline-primary"
                    @click.prevent="addLesson"
                >
                    <svg-loader class="inline fill-primary dark:fill-slate-500" name="icon-plus"></svg-loader>

                    {{ $t('add lesson') }}
                </base-button>
            </div>
        </template>
    </create-edit-modal>
</template>
