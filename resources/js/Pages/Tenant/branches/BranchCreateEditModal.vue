<script lang="ts" setup>
import { useBranchesStore } from '@/stores/branches'
import { router } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import CitySelector from '@/Components/Global/CitySelector.vue'

import { __, n__ } from '@/utils/i18n'

defineProps<{ open: boolean }>()

const branchesStore = useBranchesStore()

const loading = ref(false)

const emit = defineEmits(['close', 'process'])

const handleSubmit = () => {
    loading.value = true

    branchesStore.branch.id
        ? branchesStore.updateBranch().finally(() => (loading.value = false))
        : branchesStore.createBranch().finally(() => (loading.value = false))
}

const handleSuccess = () => {
    loading.value = false

    if (Object.keys(branchesStore.errors).length === 0) {
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
}

const modalTitle = computed(() => {
    return branchesStore.branch.id ? __('update branch') : n__('add new', 0, { attribute: __('branch') })
})

const firstInputRef = ref<HTMLElement>()

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
                    {{ $t('branch name') }}
                </base-form-label>

                <base-form-input
                    id="name"
                    ref="firstInputRef"
                    v-model="branchesStore.branch.name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('branch name') })"
                    type="text"
                    @change="handleSubmit"
                />

                <div v-if="branchesStore.errors?.name" class="mt-2">
                    <base-input-error :message="branchesStore.errors.name[0]"></base-input-error>
                </div>
            </div>

            <div class="col-span-12">
                <base-form-label htmlFor="name">
                    {{ $t('branch name') }}
                </base-form-label>

                <city-selector
                    :error-message="branchesStore.errors?.city_id"
                    @select:commune="(e) => (branchesStore.branch.city_id = e)"
                ></city-selector>
            </div>
        </template>
    </create-edit-modal>
</template>
