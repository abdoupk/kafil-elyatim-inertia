<script lang="ts" setup>
/* eslint-disable vue/no-parsing-error */
import type { MembersType } from '@/types/types'

import { useBranchesStore } from '@/stores/branches'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'
import CitySelector from '@/Components/Global/CitySelector.vue'

import { __, n__ } from '@/utils/i18n'

defineProps<{
    open: boolean
    members: MembersType
}>()

// Get the branches store
const branchesStore = useBranchesStore()

// Initialize a ref for loading state
const loading = ref(false)

const form = computed(() => {
    if (branchesStore.branch.id) {
        return useForm('put', route('tenant.branches.update', branchesStore.branch.id), { ...branchesStore.branch })
    }

    return useForm('post', route('tenant.branches.store'), { ...branchesStore.branch })
})

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])

// Function to handle success and close the slideover after a delay
const handleSuccess = () => {
    setTimeout(() => {
        router.get(
            route('tenant.branches.index'),
            {},
            {
                only: ['branches'],
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

// Compute the slideover title based on the branch id
const modalTitle = computed(() => {
    return branchesStore.branch.id ? __('update branch') : n__('add new', 1, { attribute: __('branch') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the branch id
const modalType = computed(() => {
    return branchesStore.branch.id ? 'update' : 'create'
})
</script>

<template>
    <create-edit-modal
        :focusable-input="firstInputRef"
        :loading
        :modalType
        :open
        :title="modalTitle"
        size="lg"
        @close="emit('close')"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <div class="col-span-12">
                <base-form-label htmlFor="name">
                    {{ $t('branch_name') }}
                </base-form-label>

                <base-form-input
                    id="name"
                    ref="firstInputRef"
                    v-model="form.name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('branch_name') })"
                    type="text"
                    @change="form.validate('name')"
                />

                <div v-if="form.errors?.name" class="mt-2">
                    <base-input-error :message="form.errors.name"></base-input-error>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6">
                <base-form-label for="created_at">
                    {{ $t('validation.attributes.created_at') }}
                </base-form-label>

                <base-v-calendar v-model:date="form.created_at"></base-v-calendar>

                <base-form-input-error>
                    <div
                        v-if="form?.invalid('created_at')"
                        class="mt-2 text-danger"
                        data-test="error_start_date_message"
                    >
                        {{ form.errors.created_at }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="col-span-12 lg:col-span-6">
                <base-form-label htmlFor="branch_president">
                    {{ $t('branch_president') }}
                </base-form-label>

                <!-- TODO: fetch the members and map them to the vue-select -->
                <div>
                    <base-vue-select
                        :options="members"
                        :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('branch_president') })"
                        label="name"
                        track-by="name"
                        @update:value="
                            (value) => {
                                form.president_id = value.id

                                form.validate('president_id')
                            }
                        "
                    ></base-vue-select>
                </div>

                <base-form-input-error>
                    <div
                        v-if="form?.invalid('president_id')"
                        class="mt-2 text-danger"
                        data-test="error_president_message"
                    >
                        {{ form.errors.president_id }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="col-span-12">
                <city-selector
                    :error-message="form.errors.city_id"
                    @update:city-id="
                        (ev) => {
                            form.city_id = ev.id

                            form.validate('city_id')
                        }
                    "
                ></city-selector>
            </div>
        </template>
    </create-edit-modal>
</template>
