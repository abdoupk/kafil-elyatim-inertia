<script lang="ts" setup>
import type { SchoolType } from '@/types/lessons'

import { useLessonsStore } from '@/stores/lessons'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref, watch } from 'vue'

import ColorSelector from '@/Pages/Tenant/lessons/create/ColorSelector.vue'
import OrphansSelector from '@/Pages/Tenant/lessons/create/OrphansSelector.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import CreateEditModal from '@/Components/Global/CreateEditModal.vue'
import TheSchoolSelector from '@/Components/Global/TheSchoolSelector.vue'
import TheSubjectSelector from '@/Components/Global/TheSubjectSelector.vue'

import { combineDateAndTime, omit, setDateToCurrentTime } from '@/utils/helper'
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

    return useForm('post', route('tenant.lessons.store'), omit(lessonsStore.lesson, ['id']))
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

const date = ref(props.date)

watch(
    () => date.value,
    (value) => {
        form.value.start_date = combineDateAndTime(form.value.start_date, value)

        form.value.end_date = combineDateAndTime(form.value.end_date, value)
    }
)

watch(
    () => props.date,
    (value) => {
        const formattedDate = setDateToCurrentTime(value)

        form.value.start_date = formattedDate.toDate()

        form.value.end_date = formattedDate.add(1, 'hour').toDate()

        date.value = formattedDate.toDate()
    }
)

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

            <!-- Begin: Date Range-->
            <div class="col-span-12 grid grid-cols-12 gap-4">
                <div class="col-span-12 sm:col-span-4">
                    <base-form-label for="date">
                        {{ $t('validation.attributes.date') }}
                    </base-form-label>

                    <base-v-calendar v-model:date="date" mode="date"></base-v-calendar>
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <base-form-label for="start_date">
                        {{ $t('validation.attributes.start_date') }}
                    </base-form-label>

                    <base-v-calendar
                        v-model:date="form.start_date"
                        :placeholder="
                            $t('auth.placeholders.fill', { attribute: $t('validation.attributes.start_date') })
                        "
                        hide-time-header
                        is24hr
                        mode="time"
                    ></base-v-calendar>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('start_date')"
                            class="mt-2 text-danger"
                            data-test="error_start_date_message"
                        >
                            {{ form.errors.start_date }}
                        </div>
                    </base-form-input-error>
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <base-form-label for="end_date">
                        {{ $t('validation.attributes.end_date') }}
                    </base-form-label>

                    <base-v-calendar
                        v-model:date="form.end_date"
                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.end_date') })"
                        hide-time-header
                        is24hr
                        mode="time"
                    ></base-v-calendar>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('end_date')"
                            class="mt-2 text-danger"
                            data-test="error_end_date_message"
                        >
                            {{ form.errors.end_date }}
                        </div>
                    </base-form-input-error>
                </div>
            </div>
            <!-- End: Date Range-->

            <!-- Begin: Frequency-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="frequency">
                    {{ $t('validation.attributes.frequency') }}
                </base-form-label>

                <base-form-select id="frequency" v-model="form.frequency" placeholder="ddd">
                    <option value="">{{ $t('none') }}</option>
                    <option value="daily">{{ $t('daily') }}</option>
                    <option value="weekly">{{ $t('weekly') }}</option>
                    <option value="monthly">{{ $t('monthly') }}</option>
                </base-form-select>

                <div v-if="form.errors?.frequency" class="mt-2">
                    <base-input-error :message="form.errors.frequency"></base-input-error>
                </div>
            </div>
            <!-- End: Frequency-->

            <!-- Begin: Interval-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="interval">
                    {{ $t('validation.attributes.interval') }}
                </base-form-label>

                <base-form-input
                    id="interval"
                    v-model="form.interval"
                    :placeholder="$t('placeholders.fill_interval')"
                    type="number"
                ></base-form-input>

                <div v-if="form.errors?.interval" class="mt-2">
                    <base-input-error :message="form.errors.interval"></base-input-error>
                </div>
            </div>
            <!-- End: Interval-->

            <!-- Begin: Until-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="until">
                    {{ $t('validation.attributes.until') }}
                </base-form-label>

                <base-v-calendar
                    id="until"
                    v-model:date="form.until"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.until') })"
                    type="text"
                ></base-v-calendar>

                <div v-if="form.errors?.until" class="mt-2">
                    <base-input-error :message="form.errors.until"></base-input-error>
                </div>
            </div>
            <!-- End: Until-->

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
