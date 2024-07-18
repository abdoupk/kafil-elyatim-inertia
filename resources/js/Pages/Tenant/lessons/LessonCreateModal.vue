<script lang="ts" setup>
/* eslint-disable vue/no-parsing-error */

import { useLessonsStore } from '@/stores/lessons'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import { __, n__ } from '@/utils/i18n'
import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'
import ColorSelector from '@/Pages/Tenant/lessons/ColorSelector.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import { omit } from '@/utils/helper'

defineProps<{
    open: boolean
    subjects: string[]
    schools: string[]
    orphans: string[]
    date: string
}>()

// Get the lessons store
const lessonsStore = useLessonsStore()

// Initialize a ref for loading state
const loading = ref(false)

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

            <!-- Begin: Start Date-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="start_date">
                    {{ $t('start_date') }}
                </base-form-label>

                <base-v-calendar id="start_date" v-model:date="form.start_date"
                                 :placeholder="$t('auth.placeholders.fill', { attribute: $t('start_date') })"
                                 hide-time-header
                                 is24hr
                                 mode="dateTime"
                                 type="text"></base-v-calendar>

                <div v-if="form.errors?.start_date" class="mt-2">
                    <base-input-error :message="form.errors.start_date"></base-input-error>
                </div>
            </div>
            <!-- End: Start Date-->

            <!-- Begin: End Date-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="end_date">
                    {{ $t('end_date') }}
                </base-form-label>

                <base-v-calendar id="end_date" v-model:date="form.end_date"
                                 :placeholder="$t('auth.placeholders.fill', { attribute: $t('end_date') })"
                                 hide-time-header
                                 is24hr
                                 mode="dateTime"
                                 type="text"></base-v-calendar>

                <div v-if="form.errors?.end_date" class="mt-2">
                    <base-input-error :message="form.errors.end_date"></base-input-error>
                </div>
            </div>
            <!-- End: End Date-->

            <!-- Begin: Frequency-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="frequency">
                    {{ $t('frequency') }}
                </base-form-label>

                <base-form-select id="frequency" v-model="form.frequency">
                    <option value="daily">{{ $t('daily') }}</option>
                    <option value="weekly">{{ $t('weekly') }}</option>
                    <option value="monthly">{{ $t('monthly') }}</option>
                </base-form-select>

                <div v-if="form.errors?.frequency" class="mt-2">
                    <base-input-error :message="form.errors.interval"></base-input-error>
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

                <base-v-calendar id="until" v-model:date="form.until"
                                 :placeholder="$t('auth.placeholders.fill', { attribute: $t('until') })"
                                 type="text"></base-v-calendar>

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

                <base-vue-select
                    id="school"
                    v-model:value="form.school"
                    :options="schools"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_school') })"
                    class="h-full w-full"
                    label="name"
                    track-by="id"
                >
                </base-vue-select>

                <div v-if="form.errors?.school" class="mt-2">
                    <base-input-error :message="form.errors.school"></base-input-error>
                </div>
            </div>
            <!-- End: School-->

            <!-- Begin: Subject-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="subject">
                    {{ $t('the_subject') }}
                </base-form-label>

                <base-vue-select
                    id="subject"
                    v-model:value="form.subject"
                    :options="subjects"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_subject') })"
                    class="h-full w-full"
                    label="name"
                    track-by="id"
                >
                </base-vue-select>

                <div v-if="form.errors?.subject" class="mt-2">
                    <base-input-error :message="form.errors.subject"></base-input-error>
                </div>
            </div>
            <!-- End: Subject-->

            <!-- Begin: Orphans-->
            <div class="col-span-12">
                <base-form-label htmlFor="orphans">
                    {{ $t('the_child') }}
                </base-form-label>

                <base-vue-select
                    id="orphans"
                    v-model:value="form.orphans"
                    :options="orphans"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_child') })"
                    class="h-full w-full"
                    label="name"
                    multiple
                    track-by="id"
                >
                </base-vue-select>

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

                <color-selector :model-value="form.color" class="col-span-12"
                                @update:model-value="form.color=$event"></color-selector>
            </div>
        </template>
    </create-edit-modal>
</template>
