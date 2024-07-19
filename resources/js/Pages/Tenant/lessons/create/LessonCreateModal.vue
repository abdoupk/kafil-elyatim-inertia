<script lang="ts" setup>
/* eslint-disable vue/no-parsing-error */
import type { OrphanType, SchoolType, SubjectType } from '@/types/lessons'

import { useLessonsStore } from '@/stores/lessons'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref, watch } from 'vue'

import CreateEditSlideOver from '@/Pages/Shared/CreateEditSlideOver.vue'
import ColorSelector from '@/Pages/Tenant/lessons/create/ColorSelector.vue'
import DateRange from '@/Pages/Tenant/lessons/create/DateRange.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { omit, setDateToCurrentTime } from '@/utils/helper'
import { __, n__ } from '@/utils/i18n'

const props = defineProps<{
    open: boolean
    subjects: SubjectType[]
    schools: SchoolType[]
    orphans: OrphanType[]
    date: string | Date
}>()

// Get the lessons store
const lessonsStore = useLessonsStore()

// Initialize a ref for loading state
const loading = ref(false)

const vueSelectSubjects = ref([])

const vueSelectSchools = ref([])

const vueSelectOrphans = ref([])

const form = computed(() => {
    if (lessonsStore.lesson.id) {
        return useForm('put', route('tenant.members.update', lessonsStore.lesson.id), { ...lessonsStore.lesson })
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
    return lessonsStore.lesson.id ? __('update lesson') : n__('add new', 0, { attribute: __('lesson') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the lesson id
const modalType = computed(() => {
    return lessonsStore.lesson.id ? 'update' : 'create'
})

const range = ref<{ start: string | Date; end: string | Date }>({
    start: form.value.start_date,
    end: form.value.end_date
})

watch(
    () => range.value,
    (value) => {
        form.value.start_date = value.start

        form.value.end_date = value.end
    }
)

watch(
    () => props.date,
    (value) => {
        const date = setDateToCurrentTime(value)

        range.value = {
            start: date.toDate(),
            end: date.add(1, 'hour').toDate()
        }
    }
)
</script>

<template>
    <create-edit-slide-over
        :focusable-input="firstInputRef"
        :loading
        :open
        :slideover-type="modalType"
        :title="modalTitle"
        size="xl"
        @close="emit('close')"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <div class="grid grid-cols-12 gap-4 gap-y-3">
                <!-- Begin: Title-->
                <div class="col-span-12 sm:col-span-6">
                    <base-form-label htmlFor="title">
                        {{ $t('title') }}
                    </base-form-label>

                    <base-form-input
                        id="title"
                        ref="firstInputRef"
                        v-model="form.title"
                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('title') })"
                        type="text"
                        @change="form.validate('title')"
                    />

                    <div v-if="form.errors?.title" class="mt-2">
                        <base-input-error :message="form.errors.title"></base-input-error>
                    </div>
                </div>
                <!-- End: Title-->

                <!-- Begin: Date Range-->
                <date-range v-model:range="range">
                    <template #label_start>
                        <base-form-label htmlFor="start_date">
                            {{ $t('start_date') }}
                        </base-form-label>
                    </template>

                    <template #label_end>
                        <base-form-label htmlFor="end_date">
                            {{ $t('end_date') }}
                        </base-form-label>
                    </template>

                    <template #error_start>
                        <div v-if="form.errors?.start_date" class="mt-2">
                            <base-input-error :message="form.errors.start_date"></base-input-error>
                        </div>
                    </template>

                    <template #error_end>
                        <div v-if="form.errors?.end_date" class="mt-2">
                            <base-input-error :message="form.errors.end_date"></base-input-error>
                        </div>
                    </template>
                </date-range>
                <!-- End: Date Range-->

                <!-- Begin: Frequency-->
                <div class="col-span-12 sm:col-span-6">
                    <base-form-label htmlFor="frequency">
                        {{ $t('frequency') }}
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
                        {{ $t('interval') }}
                    </base-form-label>

                    <base-form-input id="interval" v-model="form.interval" type="number"></base-form-input>

                    <div v-if="form.errors?.interval" class="mt-2">
                        <base-input-error :message="form.errors.interval"></base-input-error>
                    </div>
                </div>
                <!-- End: Interval-->

                <!-- Begin: Until-->
                <div class="col-span-12 sm:col-span-6">
                    <base-form-label htmlFor="until">
                        {{ $t('until') }}
                    </base-form-label>

                    <base-v-calendar
                        id="until"
                        v-model:date="form.until"
                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('until') })"
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
                        <base-vue-select
                            id="school"
                            v-model:value="vueSelectSchools"
                            :allow-empty="false"
                            :options="schools"
                            :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_school') })"
                            class="h-full w-full"
                            label="name"
                            track-by="id"
                            @update:value="
                                (value) => {
                                    form.school_id = value.id

                                    form?.validate('school_id')
                                }
                            "
                        >
                        </base-vue-select>
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
                        <base-vue-select
                            id="subject"
                            v-model:value="vueSelectSubjects"
                            :allow-empty="false"
                            :options="subjects"
                            :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_child') })"
                            class="h-full w-full"
                            label="name"
                            track-by="id"
                            @update:value="
                                (value) => {
                                    form.subject_id = value.id

                                    form?.validate('subject_id')
                                }
                            "
                        >
                        </base-vue-select>
                    </div>

                    <div v-if="form.errors.subject_id" class="mt-2">
                        <base-input-error :message="form.errors.subject_id"></base-input-error>
                    </div>
                </div>
                <!-- End: Subject-->

                <!-- Begin: Orphans-->
                <div class="col-span-12">
                    <base-form-label htmlFor="orphans">
                        {{ $t('the_children') }}
                    </base-form-label>

                    <div>
                        <base-vue-select
                            id="orphans"
                            v-model:value="vueSelectOrphans"
                            :allow-empty="false"
                            :options="orphans"
                            :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_children') })"
                            class="h-full w-full"
                            label="name"
                            multiple
                            track-by="id"
                            @update:value="
                                (value) => {
                                    form.orphans = value.map((orphan) => orphan.id)

                                    form?.validate('orphans')
                                }
                            "
                        >
                        </base-vue-select>
                    </div>

                    <div v-if="form.errors?.orphans" class="mt-2">
                        <base-input-error :message="form.errors.orphans"></base-input-error>
                    </div>
                </div>
                <!-- End: Orphans-->

                <!-- Begin: Color-->
                <div class="col-span-12">
                    <base-form-label htmlFor="color">
                        {{ $t('color') }}
                    </base-form-label>

                    <color-selector
                        :model-value="form.color"
                        class="col-span-12"
                        @update:model-value="form.color = $event"
                    ></color-selector>

                    <div v-if="form.errors?.color" class="mt-2">
                        <base-input-error :message="form.errors.color"></base-input-error>
                    </div>
                </div>
            </div>
        </template>
    </create-edit-slide-over>
</template>
