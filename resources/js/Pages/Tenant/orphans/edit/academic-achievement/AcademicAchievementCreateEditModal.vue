<script lang="ts" setup>
/* eslint-disable vue/no-parsing-error */
import type { AcademicLevelType } from '@/types/lessons'

import { useAcademicAchievementsStore } from '@/stores/academic-achievement'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref, watch } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseFormTextArea from '@/Components/Base/form/BaseFormTextArea.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { __, n__ } from '@/utils/i18n'
import { getAcademicLevelFromId } from '@/utils/helper'

const props = defineProps<{
    open: boolean
    academicLevels: AcademicLevelType[]
}>()

// Get the academicAchievement store
const academicAchievementStore = useAcademicAchievementsStore()

// Initialize a ref for loading state
const loading = ref(false)

const form = computed(() => {
    if (academicAchievementStore.academicAchievement.id) {
        return useForm(
            'put',
            route('tenant.academic-achievements.update', academicAchievementStore.academicAchievement.id),
            { ...academicAchievementStore.academicAchievement }
        )
    }

    return useForm('post', route('tenant.academic-achievements.store'), {
        ...academicAchievementStore.academicAchievement
    })
})

const currentYear = new Date().getFullYear(),
    years = Array(11)
        .fill(0)
        .map((_, i) => currentYear + (i - 10))

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])

// Function to handle success and close the slideover after a delay
const handleSuccess = () => {
    setTimeout(() => {
        router.get(
            route('tenant.academicAchievement.index'),
            {},
            {
                only: ['academicAchievement'],
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
    return academicAchievementStore.academicAchievement.id
        ? __('update school')
        : n__('add new', 0, { attribute: __('school') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

const vueSelectAcademicLevel = ref('')

// Compute the slideover type based on the school id
const modalType = computed(() => {
    return academicAchievementStore.academicAchievement.id ? 'update' : 'create'
})

// Watch for changes in the academic level
watch(
    () => academicAchievementStore.academicAchievement.academic_level_id,
    (value) => {
        vueSelectAcademicLevel.value = getAcademicLevelFromId(value, props.academicLevels)
    }
)
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
            <!-- Begin: Academic Level-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="academic_level_id">
                    {{ $t('validation.attributes.academic_level_id') }}
                </base-form-label>

                <div>
                    <base-vue-select
                        id="academic_level"
                        v-model:value="vueSelectAcademicLevel"
                        :allow-empty="false"
                        :options="academicLevels"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.sponsor.academic_level')
                            })
                        "
                        class="h-full w-full"
                        group-label="phase"
                        group-values="levels"
                        label="name"
                        track-by="id"
                        @update:value="
                            (value) => {
                                form.academic_level_id = value.id

                                form?.validate('academic_level_id')
                            }
                        "
                    >
                    </base-vue-select>
                </div>

                <div v-if="form.errors?.academic_level_id" class="mt-2">
                    <base-input-error :message="form.errors.academic_level_id"></base-input-error>
                </div>
            </div>
            <!-- End: Academic Level-->

            <!-- Begin: Academic Year-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="academic_year">
                    {{ $t('academic_year') }}
                </base-form-label>

                <base-form-select
                    id="academic_year"
                    v-model="form.academic_year"
                    @change="form.validate('academic_year')"
                >
                    <option v-for="year in years" :key="year" :value="year">
                        {{ year }}
                    </option>
                </base-form-select>

                <div v-if="form.errors?.academic_year" class="mt-2">
                    <base-input-error :message="form.errors.academic_year"></base-input-error>
                </div>
            </div>
            <!-- End: Academic Year-->

            <!-- Begin: First Trimester-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="first_trimester">
                    {{ $t('first_trimester') }}
                </base-form-label>

                <base-form-input
                    id="first_trimester"
                    v-model="form.first_trimester"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('first_trimester') })"
                    step="0.01"
                    type="number"
                    @change="form.validate('first_trimester')"
                ></base-form-input>

                <div v-if="form.errors?.first_trimester" class="mt-2">
                    <base-input-error :message="form.errors.first_trimester"></base-input-error>
                </div>
            </div>
            <!-- End: First Trimester-->

            <!-- Begin: Second Trimester-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="second_trimester">
                    {{ $t('second_trimester') }}
                </base-form-label>

                <base-form-input
                    id="second_trimester"
                    v-model="form.second_trimester"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('second_trimester') })"
                    step="0.01"
                    type="number"
                    @change="form.validate('second_trimester')"
                ></base-form-input>

                <div v-if="form.errors?.second_trimester" class="mt-2">
                    <base-input-error :message="form.errors.second_trimester"></base-input-error>
                </div>
            </div>
            <!-- End: Second Trimester-->

            <!-- Begin: Third Trimester-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="third_trimester">
                    {{ $t('third_trimester') }}
                </base-form-label>

                <base-form-input
                    id="third_trimester"
                    v-model="form.third_trimester"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('third_trimester') })"
                    step="0.01"
                    type="number"
                    @change="form.validate('third_trimester')"
                ></base-form-input>

                <div v-if="form.errors?.third_trimester" class="mt-2">
                    <base-input-error :message="form.errors.third_trimester"></base-input-error>
                </div>
            </div>
            <!-- End: Third Trimester-->

            <!-- Begin: General Average-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="average">
                    {{ $t('general_average') }}
                </base-form-label>

                <base-form-input
                    id="average"
                    v-model="form.average"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('general_average') })"
                    step="0.01"
                    type="number"
                    @change="form.validate('average')"
                ></base-form-input>

                <div v-if="form.errors?.average" class="mt-2">
                    <base-input-error :message="form.errors.average"></base-input-error>
                </div>
            </div>
            <!-- End: General Average-->

            <!-- Begin: Note-->
            <div class="col-span-12">
                <base-form-label for="note">
                    {{ $t('notes') }}
                </base-form-label>

                <base-form-text-area
                    id="note"
                    v-model="form.note"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('notes')
                        })
                    "
                    rows="6"
                    @change="form?.validate('note')"
                ></base-form-text-area>

                <base-form-input-error>
                    <div v-if="form?.invalid('note')" class="mt-2 text-danger" data-test="error_note_message">
                        {{ form.errors.note }}
                    </div>
                </base-form-input-error>
            </div>
            <!-- End: Note-->
        </template>
    </create-edit-modal>
</template>
