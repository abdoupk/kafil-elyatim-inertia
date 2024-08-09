<script lang="ts" setup>
import { useZonesStore } from '@/stores/zones'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormTextArea from '@/Components/Base/form/BaseFormTextArea.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import CreateEditModal from '@/Components/Global/CreateEditModal.vue'

import { __, n__ } from '@/utils/i18n'

defineProps<{
    open: boolean
}>()

// Get the zones store
const zonesStore = useZonesStore()

// Initialize a ref for loading state
const loading = ref(false)

const form = computed(() => {
    if (zonesStore.zone.id) {
        return useForm('put', route('tenant.zones.update', zonesStore.zone.id), { ...zonesStore.zone })
    }

    return useForm('post', route('tenant.zones.store'), { ...zonesStore.zone })
})

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])

// Function to handle success and close the slideover after a delay
const handleSuccess = () => {
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

// Function to handle form submission
const handleSubmit = async () => {
    loading.value = true

    try {
        await form.value.submit().then(handleSuccess)
    } finally {
        loading.value = false
    }
}

// Compute the slideover title based on the zone id
const modalTitle = computed(() => {
    return zonesStore.zone.id
        ? __('modal_update_title', {
              attribute: __('the_zone')
          })
        : n__('add new', 0, { attribute: __('zone') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the zone id
const modalType = computed(() => {
    return zonesStore.zone.id ? 'update' : 'create'
})
</script>

<template>
    <create-edit-modal
        :focusable-input="firstInputRef"
        :loading
        :modal-type="modalType"
        :open
        :title="modalTitle"
        @close="emit('close')"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <!-- Begin: Name-->
            <div class="col-span-12">
                <base-form-label htmlFor="name">
                    {{ $t('validation.attributes.name') }}
                </base-form-label>

                <base-form-input
                    id="name"
                    ref="firstInputRef"
                    v-model="form.name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.name') })"
                    type="text"
                    @change="form.validate('name')"
                />

                <div v-if="form.errors?.name" class="mt-2">
                    <base-input-error :message="form.errors.name"></base-input-error>
                </div>
            </div>
            <!-- End: Name-->

            <!-- Begin: Name-->
            <div class="col-span-12">
                <base-form-label htmlFor="description">
                    {{ $t('validation.attributes.description') }}
                </base-form-label>

                <base-form-text-area
                    id="description"
                    v-model="form.description"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.description') })"
                    rows="5"
                    @change="form.validate('description')"
                />

                <div v-if="form.errors?.description" class="mt-2">
                    <base-input-error :message="form.errors.description"></base-input-error>
                </div>
            </div>
            <!-- End: Name-->
        </template>
    </create-edit-modal>
</template>
