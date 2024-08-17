<script lang="ts" setup>
import { useFinancialTransactionsStore } from '@/stores/financial-transactions'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, defineAsyncComponent, ref } from 'vue'

import SuccessNotification from '@/Components/Global/SuccessNotification.vue'

import { financialTransactionSpecifications } from '@/utils/constants'
import { __, n__ } from '@/utils/i18n'

const BaseVCalendar = defineAsyncComponent(() => import('@/Components/Base/VCalendar/BaseVCalendar.vue'))

const BaseFormInput = defineAsyncComponent(() => import('@/Components/Base/form/BaseFormInput.vue'))

const BaseFormLabel = defineAsyncComponent(() => import('@/Components/Base/form/BaseFormLabel.vue'))

const BaseFormTextArea = defineAsyncComponent(() => import('@/Components/Base/form/BaseFormTextArea.vue'))

const BaseInputError = defineAsyncComponent(() => import('@/Components/Base/form/BaseInputError.vue'))

const BaseVueSelect = defineAsyncComponent(() => import('@/Components/Base/vue-select/BaseVueSelect.vue'))

const CreateEditModal = defineAsyncComponent(() => import('@/Components/Global/CreateEditModal.vue'))

const TheMemberSelector = defineAsyncComponent(() => import('@/Components/Global/TheMemberSelector.vue'))

defineProps<{
    open: boolean
}>()

// Get the financialTransactions store
const financialTransactionsStore = useFinancialTransactionsStore()

const showSuccessNotification = ref(false)

const notificationTitle = computed(() => {
    // Return financialTransactionsStore.financialTransaction.id
    //     ? __('successfully_updated')
    //     : __('successfully_created', { attribute: __('the_branch') })

    if (financialTransactionsStore.financialTransaction.id) {
        return __('successfully_updated')
    } else {
        return financialTransactionsStore.financialTransaction.type == 'income'
            ? __('successfully_created', { attribute: __('new income') })
            : __('successfully_created', { attribute: __('new expense') })
    }
})

// Initialize a ref for loading state
const loading = ref(false)

const form = computed(() => {
    if (financialTransactionsStore.financialTransaction.id) {
        return useForm('put', route('tenant.financial.update', financialTransactionsStore.financialTransaction.id), {
            ...financialTransactionsStore.financialTransaction
        })
    }

    return useForm('post', route('tenant.financial.store'), { ...financialTransactionsStore.financialTransaction })
})

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])

// Function to handle success and close the slideover after a delay
const handleSuccess = () => {
    setTimeout(() => {
        router.get(
            route('tenant.financial.index'),
            {},
            {
                only: ['finances'],
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
        await form.value
            .submit({
                onSuccess() {
                    showSuccessNotification.value = true
                },
                onFinish() {
                    showSuccessNotification.value = false
                }
            })
            .then(handleSuccess)
    } finally {
        loading.value = false
    }
}

// Compute the slideover title based on the financialTransaction id
const modalTitle = computed(() => {
    return financialTransactionsStore.financialTransaction.id
        ? __('update financialTransaction')
        : n__('add new', 0, { attribute: __('financialTransaction') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the financialTransaction id
const modalType = computed(() => {
    return financialTransactionsStore.financialTransaction.id ? 'update' : 'create'
})

const financialTransactionSpecificationsLabels = ({ label }: { label: string }) => {
    return __(label)
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
            <!-- Begin: Amount  -->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="the_amount">
                    {{ $t('validation.attributes.the_amount') }}
                </base-form-label>

                <base-form-input
                    id="the_amount"
                    ref="firstInputRef"
                    v-model="form.amount"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.amount') })"
                    type="text"
                    @change="form.validate('amount')"
                />

                <div v-if="form.errors?.amount" class="mt-2">
                    <base-input-error :message="form.errors.amount"></base-input-error>
                </div>
            </div>
            <!-- End: Amount  -->

            <!-- Begin: Date  -->
            <div class="col-span-12 sm:col-span-4">
                <base-form-label htmlFor="date">
                    {{ $t('validation.attributes.date') }}
                </base-form-label>

                <base-v-calendar></base-v-calendar>

                <div v-if="form.errors?.date" class="mt-2">
                    <base-input-error :message="form.errors.date"></base-input-error>
                </div>
            </div>
            <!-- End: Date  -->

            <!-- Begin: Specification  -->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="specification">
                    {{ $t('validation.attributes.specification') }}
                </base-form-label>

                <div>
                    <!--TODO Fix This-->
                    <base-vue-select
                        v-model:value="form.formatted_specification"
                        :custom-label="financialTransactionSpecificationsLabels"
                        :options="financialTransactionSpecifications"
                        :placeholder="
                            $t('auth.placeholders.tomselect', { attribute: $t('validation.attributes.the_status') })
                        "
                        label="label"
                        track_by="value"
                        @update:value="
                            (specification) => {
                                form.specification = specification.value

                                form?.validate('specification')
                            }
                        "
                    ></base-vue-select>
                </div>

                <div v-if="form.errors?.specification" class="mt-2">
                    <base-input-error :message="form.errors.specification"></base-input-error>
                </div>
            </div>
            <!-- End: Specification  -->

            <!-- Begin: member  -->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="the_member">
                    {{ $t('receiving_member') }}
                </base-form-label>

                <div>
                    <the-member-selector
                        v-model:member="form.member_id"
                        :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_member') })"
                        multiple
                        @update:members="form?.validate('member_id')"
                    ></the-member-selector>
                </div>

                <div v-if="form.errors?.member_id" class="mt-2">
                    <base-input-error :message="form.errors.member_id"></base-input-error>
                </div>
            </div>
            <!-- End: member  -->

            <!-- Begin: Description  -->
            <div class="col-span-12">
                <base-form-label htmlFor="description">
                    {{ $t('validation.attributes.description') }}
                </base-form-label>

                <base-form-text-area
                    id="description"
                    v-model="form.description"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.description') })"
                    rows="7"
                    @change="form.validate('description')"
                />

                <div v-if="form.errors?.description" class="mt-2">
                    <base-input-error :message="form.errors.description"></base-input-error>
                </div>
            </div>
            <!-- End: Description  -->
        </template>
    </create-edit-modal>

    <success-notification :open="showSuccessNotification" :title="notificationTitle"></success-notification>
</template>
