<script lang="ts" setup>
import { useRolesStore } from '@/stores/roles'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref } from 'vue'

import CreateEditSlideOver from '@/Pages/Shared/CreateEditSlideOver.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
import BaseFormSwitchLabel from '@/Components/Base/form/form-switch/BaseFormSwitchLabel.vue'

import { permissions } from '@/utils/constants'
import { __, n__ } from '@/utils/i18n'

defineProps<{
    open: boolean
}>()

// Get the roles store
const rolesStore = useRolesStore()

// Initialize a ref for loading state
const loading = ref(false)

const form = computed(() => {
    if (rolesStore.role.uuid) {
        return useForm('put', route('tenant.roles.update', rolesStore.role.uuid), { ...rolesStore.role })
    }

    return useForm('post', route('tenant.roles.store'), { ...rolesStore.role })
})

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])

// Function to handle success and close the slideover after a delay
const handleSuccess = () => {
    setTimeout(() => {
        router.get(
            route('tenant.roles.index'),
            {},
            {
                only: ['roles'],
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

// Compute the slideover title based on the role id
const modalTitle = computed(() => {
    return rolesStore.role.uuid ? __('update role') : n__('add new', 1, { attribute: __('role') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the role id
const modalType = computed(() => {
    return rolesStore.role.uuid ? 'update' : 'create'
})
</script>

<template>
    <create-edit-slide-over
        :focusable-input="firstInputRef"
        :loading
        :open
        :slideover-type="modalType"
        :title="modalTitle"
        size="lg"
        @close="emit('close')"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <div class="col-span-12">
                <base-form-label htmlFor="name">
                    {{ $t('validation.attributes.role_name') }}
                </base-form-label>

                <base-form-input
                    id="name"
                    ref="firstInputRef"
                    v-model="form.name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.role_name') })"
                    type="text"
                    @change="form.validate('name')"
                />

                <div v-if="form.errors?.name" class="mt-2">
                    <base-input-error :message="form.errors.name"></base-input-error>
                </div>
            </div>

            <div class="col-span-12 mt-6">
                <div v-for="(permissionMaps, key, index) in permissions" :key="index">
                    <h2 class="rtl:font-bold ltr:font-medium mb-2 text-base/relaxed mt-2">
                        {{ $t(`the_${key}`) }}
                    </h2>

                    <div class="gap-3 grid grid-cols-4">
                        <div v-for="permission in permissionMaps" :key="permission">
                            <div class="">
                                <base-form-switch>
                                    <base-form-switch-input
                                        v-model="form.permissions[`${permission}_${key}`]"
                                        type="checkbox"
                                    ></base-form-switch-input>

                                    <base-form-switch-label>
                                        {{ `${$t(`permissions.${permission}`)}` }}
                                    </base-form-switch-label>
                                </base-form-switch>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </create-edit-slide-over>
</template>
