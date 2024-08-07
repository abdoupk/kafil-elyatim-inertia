<script lang="ts" setup>
import { useBranchesStore } from '@/stores/branches'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'
import TheMemberSelector from '@/Pages/Shared/TheMemberSelector.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import TheCitySelector from '@/Components/Global/CitySelector/TheCitySelector.vue'

import { omit } from '@/utils/helper'
import { __, n__ } from '@/utils/i18n'

// TODO remove members and replace by selector in the future search members: MembersType
defineProps<{
    open: boolean
}>()

// Get the branches store
const branchesStore = useBranchesStore()

// Initialize a ref for loading state
const loading = ref(false)

const form = computed(() => {
    if (branchesStore.branch.id) {
        return useForm(
            'put',
            route('tenant.branches.update', branchesStore.branch.id),
            omit(branchesStore.branch, ['city'])
        )
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
                preserveState: true,
                preserveScroll: true
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

                <div>
                    <the-member-selector
                        v-model:member="form.president_id"
                        :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('branch_president') })"
                        @update:members="form?.validate('president_id')"
                    ></the-member-selector>
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
                <the-city-selector
                    v-model:city="branchesStore.branch.city"
                    v-model:city-id="form.city_id"
                    :error-message="form.errors.city_id"
                    @update:city-id="
                        () => {
                            form.validate('city_id')
                        }
                    "
                ></the-city-selector>
            </div>
        </template>
    </create-edit-modal>
</template>
