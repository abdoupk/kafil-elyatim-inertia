<script lang="ts" setup>
import { useBranchesStore } from '@/stores/branches'
import { computed, ref } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import CitySelector from '@/Components/Global/CitySelector.vue'

import { __, n__ } from '@/utils/i18n'
import BaseTomSelect from '@/Components/Base/tom-select/BaseTomSelect.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import type { MembersType } from '@/types/types'

defineProps<{
    open: boolean
    members: MembersType
}>()

const branchesStore = useBranchesStore()

const loading = ref(false)

const emit = defineEmits(['close', 'process'])

const handleSubmit = () => {
    loading.value = true

    branchesStore.branch.id
        ? branchesStore.updateBranch().finally(() => (loading.value = false))
        : branchesStore.createBranch().finally(() => (loading.value = false))
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

            <div class="col-span-12">
                <city-selector
                    :error-message="form.errors.city_id"
                    @change="form.validate('city_id')"
                    @select:commune="(e) => (
                        // @ts-ignore
                        form.city_id = e)"
                ></city-selector>
            </div>

            <div class="col-span-12 lg:col-span-6">
                <base-form-label htmlFor="branch_president">
                    {{ $t('branch_president') }}
                </base-form-label>

                <div>
                    <base-tom-select
                        :data-placeholder="$t('auth.placeholders.tomselect', { attribute: $t('branch_president') })"
                        :model-value="branchesStore.branch.president_id"
                        @update:model-value="setBranchPresident"
                    >
                        <option v-for="member in members" :key="member.id" :value="member.id">{{ member.name }}</option>
                    </base-tom-select>
                </div>

                <base-form-input-error>
                    <div v-if="form?.invalid('president_id')" class="mt-2 text-danger" data-test="error_zone_message">
                        {{ form.errors.president_id }}
                    </div>
                </base-form-input-error>
            </div>
        </template>
    </create-edit-modal>
</template>
