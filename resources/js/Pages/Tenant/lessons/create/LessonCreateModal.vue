<script lang="ts" setup>
import type { SchoolType } from '@/types/lessons'
import type { CreateLessonForm } from '@/types/types'

import { useLessonsStore } from '@/stores/lessons'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref, watch } from 'vue'

import ColorSelector from '@/Pages/Tenant/lessons/create/ColorSelector.vue'
import DateSelector from '@/Pages/Tenant/lessons/create/DateSelector.vue'
import OrphansSelector from '@/Pages/Tenant/lessons/create/OrphansSelector.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import CreateEditModal from '@/Components/Global/CreateEditModal.vue'
import TheSchoolSelector from '@/Components/Global/TheSchoolSelector.vue'
import TheSubjectSelector from '@/Components/Global/TheSubjectSelector.vue'

import { omit } from '@/utils/helper'
import { __, n__ } from '@/utils/i18n'

const props = defineProps<{
    open: boolean
    schools: SchoolType[]
    date: string | Date
}>()

// Get the lessons store
const lessonsStore = useLessonsStore()

// Initialize a ref for loading state
const loading = ref(false)

const vueSelectSubjects = ref([])

const vueSelectSchools = ref([])

const vueSelectOrphans = ref([])

const subjects = ref([])

watch(
    () => lessonsStore.lesson.formatted_school,
    (newValue) => {
        if (newValue) {
            vueSelectSchools.value = newValue
        }
    }
)

watch(
    () => vueSelectSchools.value,
    (newValue) => {
        if (newValue) {
            subjects.value = newValue.subjects

            // TODO: instead get the first subject from the list of subjects get by the id of subject
            vueSelectSubjects.value = subjects.value[0]

            form.value.subject_id = subjects.value[0].id
        }
    }
)

const form = computed(() => {
    if (lessonsStore.lesson.id) {
        return useForm('put', route('tenant.lessons.update', lessonsStore.lesson.id), { ...lessonsStore.lesson })
    }

    return useForm<CreateLessonForm>('post', route('tenant.lessons.store'), omit(lessonsStore.lesson, ['id']))
})

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])

// Function to handle success and close the slideover after a delay
const handleSuccess = () => {
    setTimeout(() => {
        router.get(
            route('tenant.lessons.index'),
            {},
            {
                only: ['events'],
                preserveState: false
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

// Compute the slideover title based on the lesson id
const modalTitle = computed(() => {
    return lessonsStore.lesson.id ? __('update lesson') : n__('add new', 1, { attribute: __('lesson') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the lesson id
const modalType = computed(() => {
    return lessonsStore.lesson.id ? 'update' : 'create'
})

const handleCloseModal = () => {
    emit('close')

    vueSelectSubjects.value = []

    vueSelectOrphans.value = []

    form.value.reset()
    // TODO: Find a way to reset the vue select schools
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
        @close="handleCloseModal"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <!-- Begin: Title-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="title">
                    {{ $t('validation.attributes.title') }}
                </base-form-label>

                <base-form-input
                    id="title"
                    ref="firstInputRef"
                    v-model="form.title"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.title') })"
                    type="text"
                    @change="form.validate('title')"
                />

                <div v-if="form.errors?.title" class="mt-2">
                    <base-input-error :message="form.errors.title"></base-input-error>
                </div>
            </div>
            <!-- End: Title-->

            <!-- Begin: Date Options-->
            <date-selector
                v-model:end-date="form.end_date"
                v-model:frequency="form.frequency"
                v-model:interval="form.interval"
                v-model:start-date="form.start_date"
                v-model:until="form.until"
                :date
                :form
            ></date-selector>
            <!-- End: Date Options-->

            <!-- Begin: School-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="school">
                    {{ $t('the_school') }}
                </base-form-label>

                <div>
                    <the-school-selector
                        id="school"
                        v-model:school="form.school_id"
                        @update:school="form?.validate('school_id')"
                    ></the-school-selector>
                </div>

                <div v-if="form.errors?.school_id" class="mt-2">
                    <base-input-error :message="form.errors.school_id"></base-input-error>
                </div>
            </div>
            <!-- End: School-->

            <!-- Begin: Subject-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="subject">
                    {{ $t('the_subject') }}
                </base-form-label>

                <div>
                    <the-subject-selector
                        id="subject"
                        v-model:subject="form.subject_id"
                        @update:subject="form?.validate('subject_id')"
                    ></the-subject-selector>
                </div>

                <div v-if="form.errors.subject_id" class="mt-2">
                    <base-input-error :message="form.errors.subject_id"></base-input-error>
                </div>
            </div>
            <!-- End: Subject-->

            <!-- Begin: Orphans-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="orphans">
                    {{ $t('the_orphans') }}
                </base-form-label>

                <div>
                    <!-- @vue-ignore -->
                    <orphans-selector
                        :academic_level_id="5"
                        :orphans="form.orphans"
                        :quota="5"
                        @update:selected-orphans="
                            (value) => {
                                form.orphans = value.map((orphan) => orphan.id)

                                form?.validate('orphans')
                            }
                        "
                    ></orphans-selector>
                </div>

                <div v-if="form.errors?.orphans" class="mt-2">
                    <base-input-error :message="form.errors.orphans"></base-input-error>
                </div>
            </div>
            <!-- End: Orphans-->

            <!-- Begin: Color-->
            <div class="col-span-12 mt-0">
                <base-form-label htmlFor="color">
                    {{ $t('validation.attributes.color') }}
                </base-form-label>

                <color-selector
                    :model-value="form.color"
                    class="col-span-12"
                    @update:model-value="
                        (value) => {
                            form.color = value

                            form.validate('color')
                        }
                    "
                ></color-selector>

                <div v-if="form.errors?.color" class="mt-2">
                    <base-input-error :message="form.errors.color"></base-input-error>
                </div>
            </div>
            <!-- End: Color-->
        </template>
    </create-edit-modal>
</template>
