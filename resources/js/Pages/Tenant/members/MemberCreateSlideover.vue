<script lang="ts" setup>
// Define props
import { useMembersStore } from '@/stores/members'
import { router } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'

import CreateEditSlideOver from '@/Pages/Shared/CreateEditSlideOver.vue'

import { __, n__ } from '@/utils/i18n'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'

defineProps<{
    open: boolean
}>()

// Get the members store
const membersStore = useMembersStore()

// Initialize a ref for loading state
const loading = ref(false)

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])

// Function to handle success and close the slideover after a delay
const handleSuccess = () => {
    setTimeout(() => {
        router.get(
            route('tenant.members.index'),
            {},
            {
                only: ['members'],
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
        if (membersStore.member.id) {
            await membersStore.updateMember()
        } else {
            await membersStore.createMember()
        }

        handleSuccess()
    } finally {
        loading.value = false
    }
}

// Compute the slideover title based on the member id
const slideoverTitle = computed(() => {
    return membersStore.member.id ? __('update member') : n__('add new', 0, { attribute: __('member') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the member id
const slideoverType = computed(() => {
    return membersStore.member.id ? 'update' : 'create'
})

// Compute the form based on the member id
const form = computed(() => {
    if (membersStore.member.id) {
        return membersStore.getUpdateMemberForm
    }

    return membersStore.getCreateMemberForm
})

// Watch for changes in the form and reset if no member id
watch(form, (value) => {
    if (!membersStore.member.id) {
        value.reset()
    }
})
</script>

<template>
    <create-edit-slide-over :focusable-input="firstInputRef"
                            :loading="loading"
                            :open="open"
                            :slideover-type="slideoverType"
                            :title="slideoverTitle"
                            size="xl"
                            @close="emit('close')"
                            @handle-submit="handleSubmit"
    >
        <template #description>
            <!-- Begin: First name-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="first_name">
                    {{ $t('validation.attributes.first_name') }}
                </base-form-label>

                <base-form-input
                    id="first_name"
                    ref="firstInputRef"
                    v-model="form.first_name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.first_name') })"
                    type="text"
                    @change="form.validate('first_name')"
                />

                <div v-if="form.errors?.first_name" class="mt-2">
                    <base-input-error :message="form.errors.first_name"></base-input-error>
                </div>
            </div>
            <!-- End: First name-->

            <!-- Begin: Last name-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="last_name">
                    {{ $t('validation.attributes.last_name') }}
                </base-form-label>

                <base-form-input
                    id="last_name"
                    v-model="form.last_name"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.last_name') })"
                    type="text"
                    @change="form.validate('last_name')"
                />

                <div v-if="form.errors?.last_name" class="mt-2">
                    <base-input-error :message="form.errors.last_name"></base-input-error>
                </div>
            </div>
            <!-- End: Last name-->

            <!-- Begin: Email-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="email">
                    {{ $t('validation.attributes.email') }}
                </base-form-label>

                <base-form-input
                    id="email"
                    v-model="form.email"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.email') })"
                    type="text"
                    @change="form.validate('email')"
                />

                <div v-if="form.errors?.email" class="mt-2">
                    <base-input-error :message="form.errors.email"></base-input-error>
                </div>
            </div>
            <!-- End: Email-->

            <!-- Begin: Phone-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="phone">
                    {{ $t('validation.attributes.phone') }}
                </base-form-label>

                <base-form-input
                    id="phone"
                    v-model="form.phone"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.phone') })"
                    type="text"
                    @change="form.validate('phone')"
                />

                <div v-if="form.errors?.phone" class="mt-2">
                    <base-input-error :message="form.errors.phone"></base-input-error>
                </div>
            </div>
            <!-- End: Phone-->

            <template v-if="slideoverType === 'create'">
                <!-- Begin: Password-->
                <div class="col-span-12 sm:col-span-6">
                    <base-form-label htmlFor="password">
                        {{ $t('validation.attributes.password') }}
                    </base-form-label>

                    <base-form-input
                        id="password"
                        v-model="form.password"
                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.password') })"
                        type="text"
                        @change="form.validate('password')"
                    />

                    <div v-if="form.errors?.password" class="mt-2">
                        <base-input-error :message="form.errors.password"></base-input-error>
                    </div>
                </div>
                <!-- End: Password-->

                <!-- Begin: Password Confirmation-->
                <div class="col-span-12 sm:col-span-6">
                    <base-form-label htmlFor="password_confirmation">
                        {{ $t('validation.attributes.password_confirmation') }}
                    </base-form-label>

                    <base-form-input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.password_confirmation') })"
                        type="text"
                        @change="form.validate('password_confirmation')"
                    />

                    <div v-if="form.errors?.password_confirmation" class="mt-2">
                        <base-input-error :message="form.errors.password_confirmation"></base-input-error>
                    </div>
                </div>
                <!-- End: Password Confirmation-->
            </template>

            <!-- Begin: gender-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="gender">
                    {{ $t('validation.attributes.gender') }}
                </base-form-label>

                <base-form-input
                    id="gender"
                    v-model="form.gender"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.gender') })"
                    type="text"
                    @change="form.validate('gender')"
                />

                <div v-if="form.errors?.gender" class="mt-2">
                    <base-input-error :message="form.errors.gender"></base-input-error>
                </div>
            </div>
            <!-- End: gender-->

            <!-- Begin: qualification-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="qualification">
                    {{ $t('validation.attributes.qualification') }}
                </base-form-label>

                <base-form-input
                    id="qualification"
                    v-model="form.qualification"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.qualification') })"
                    type="text"
                    @change="form.validate('qualification')"
                />

                <div v-if="form.errors?.qualification" class="mt-2">
                    <base-input-error :message="form.errors.qualification"></base-input-error>
                </div>
            </div>
            <!-- End: qualification-->

            <!-- Begin: zone-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="zone">
                    {{ $t('validation.attributes.zone') }}
                </base-form-label>

                <base-form-input
                    id="zone"
                    v-model="form.zone"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.zone') })"
                    type="text"
                    @change="form.validate('zone')"
                />

                <div v-if="form.errors?.zone" class="mt-2">
                    <base-input-error :message="form.errors.zone"></base-input-error>
                </div>
            </div>
            <!-- End: zone-->

            <!-- Begin: branch-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="branch">
                    {{ $t('validation.attributes.branch') }}
                </base-form-label>

                <base-form-input
                    id="branch"
                    v-model="form.branch"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.branch') })"
                    type="text"
                    @change="form.validate('branch')"
                />

                <div v-if="form.errors?.branch" class="mt-2">
                    <base-input-error :message="form.errors.branch"></base-input-error>
                </div>
            </div>
            <!-- End: branch-->

            <!-- Begin: roles-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="roles">
                    {{ $t('validation.attributes.roles') }}
                </base-form-label>

                <base-form-input
                    id="roles"
                    v-model="form.roles"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.roles') })"
                    type="text"
                    @change="form.validate('roles')"
                />

                <div v-if="form.errors?.roles" class="mt-2">
                    <base-input-error :message="form.errors.roles"></base-input-error>
                </div>
            </div>
            <!-- End: roles-->
        </template>
    </create-edit-slide-over>
</template>
