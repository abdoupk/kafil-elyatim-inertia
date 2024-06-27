<script lang="ts" setup>
import { useZonesStore } from '@/stores/zones'
import { router } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormTextArea from '@/Components/Base/form/BaseFormTextArea.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'

import { __, n__ } from '@/utils/i18n'

defineProps<{ open: boolean }>()

const zonesStore = useZonesStore()

const loading = ref(false)

const emit = defineEmits(['close', 'process'])

const handleSubmit = async () => {
    loading.value = true

    zonesStore.zone.id
        ? await zonesStore.updateZone().finally(handleSuccess)
        : await zonesStore.createZone().finally(handleSuccess)
}

const handleSuccess = () => {
    loading.value = false

    if (Object.keys(zonesStore.errors).length === 0) {
        setTimeout(() => {
            router.get(
                route('tenant.zones.index'),
                {},
                {
                    only: ['zones'],
                    preserveState: true
                }
            )
        }, 200)

        emit('close')
    }
}

const modalTitle = computed(() => {
    return zonesStore.zone.id ? __('update zone') : n__('add new', 0, { attribute: __('zone') })
})

const firstInputRef = ref<HTMLElement>()

const modalType = computed(() => {
    return zonesStore.zone.id ? 'update' : 'create'
})
</script>

<template>
    <create-edit-modal
        :focusable-input="firstInputRef"
        :loading
        :modalType
        :open
        :title="modalTitle"
        @close="emit('close')"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <div class="col-span-12">
                <base-form-label htmlFor="name">
                    {{ $t('zone name') }}
                </base-form-label>

                <base-form-input
                    id="name"
                    ref="firstInputRef"
                    v-model="zonesStore.zone.name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('zone name') })"
                    type="text"
                />

                <div v-if="zonesStore.errors?.name" class="mt-2">
                    <base-input-error :message="zonesStore.errors.name[0]"></base-input-error>
                </div>
            </div>

            <div class="col-span-12">
                <base-form-label htmlFor="description">
                    {{ $t('validation.attributes.description') }}
                </base-form-label>

                <base-form-text-area
                    id="description"
                    v-model="zonesStore.zone.description"
                    placeholder="example@gmail.com"
                    rows="5"
                    type="text"
                />

                <div v-if="zonesStore.errors?.description" class="mt-2">
                    <base-input-error :message="zonesStore.errors.description[0]"></base-input-error>
                </div>
            </div>
        </template>
    </create-edit-modal>
</template>
