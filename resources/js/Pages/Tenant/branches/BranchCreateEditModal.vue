<script lang="ts" setup>
import type { MembersType } from '@/types/types'

import { useBranchesStore } from '@/stores/branches'
import { router } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseLitePicker from '@/Components/Base/lite-picker/BaseLitePicker.vue'
import BaseTomSelect from '@/Components/Base/tom-select/BaseTomSelect.vue'
import CitySelector from '@/Components/Global/CitySelector.vue'

import { __, n__ } from '@/utils/i18n'

defineProps<{
    open: boolean
    members: MembersType
}>()

const branchesStore = useBranchesStore()

const loading = ref(false)

const emit = defineEmits(['close', 'process'])

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

const handleSubmit = () => {
    loading.value = true

    branchesStore.branch.id
        ? branchesStore
              .updateBranch()
              .then(handleSuccess)
              .finally(() => (loading.value = false))
        : branchesStore
              .createBranch()
              .then(handleSuccess)
              .finally(() => (loading.value = false))
}

const modalTitle = computed(() => {
    return branchesStore.branch.id ? __('update branch') : n__('add new', 0, { attribute: __('branch') })
})

const firstInputRef = ref<HTMLElement>()

const modalType = computed(() => {
    return branchesStore.branch.id ? 'update' : 'create'
})

const form = computed(() => {
    if (branchesStore.branch.id) {
        return branchesStore.getUpdateBranchForm
    }

    return branchesStore.getCreateBranchForm
})

watch(form, (value) => {
    if (!branchesStore.branch.id) {
        value.reset()
    }
})

const setBranchPresident = (value: string | string[]) => {
    if (typeof value === 'string') {
        // @ts-ignore
        form.value.president_id = value

        form.value?.validate('president_id')
    }
}
</script>

<template>
    <create-edit-modal
        :focusable-input="firstInputRef"
        :loading
        :modalType
        :open
        :title="modalTitle"
        class="!overflow-auto !flex"
        size="lg"
        @close="emit('close')"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <div class="col-span-12">
                <base-form-label htmlFor="name">
                    {{ $t('branch name') }}
                </base-form-label>

                <base-form-input
                    id="name"
                    ref="firstInputRef"
                    v-model="form.name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('branch name') })"
                    type="text"
                    @change="form.validate('name')"
                />

                <div v-if="form.errors?.name" class="mt-2">
                    <base-input-error :message="form.errors.name"></base-input-error>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6">
                <base-form-label for="created_at">
                    {{ $t('validation.attributes.starting_sponsorship_date') }}
                </base-form-label>

                <base-lite-picker
                    v-model="form.created_at"
                    :options="{ format: 'DD-MM-YYYY' }"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.starting_sponsorship_date')
                        })
                    "
                    class="block"
                    id="created_at"
                    @keydown.prevent
                ></base-lite-picker>

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
                    <base-tom-select
                        :data-placeholder="$t('auth.placeholders.tomselect', { attribute: $t('branch_president') })"
                        :model-value="form.president_id"
                        :options="{ allowEmptyOption: false }"
                        @update:model-value="setBranchPresident"
                    >
                        <option value="">{{$t('auth.placeholders.tomselect', { attribute: $t('branch_president') })}}</option>
                        <option v-for="member in members" :key="member.id" :value="member.id">{{ member.name }}</option>
                    </base-tom-select>
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
                    @change="form.validate('city_id')"
                    @select:commune="
                        (e) => {
                            // @ts-ignore
                            form.city_id = e

                            form.validate('city_id')
                        }
                    "
                ></city-selector>
            </div>
        </template>
    </create-edit-modal>
</template>
