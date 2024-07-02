<script lang="ts" setup>
/* eslint-disable vue/no-parsing-error */
import type { Branch, Role, Zone } from '@/types/types'

import { useMembersStore } from '@/stores/members'
import { router } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { computed, ref } from 'vue'

import CreateEditModal from '@/Pages/Shared/CreateEditModal.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'
import { __, n__ } from '@/utils/i18n'

defineProps<{
    open: boolean
    qualifications: string[]
    branches: Branch[]
    roles: Role[]
    zones: Zone[]
}>()

// Get the members store
const membersStore = useMembersStore()

// Initialize a ref for loading state
const loading = ref(false)

const form = computed(() => {
    if (membersStore.member.id) {
        return useForm('put', route('tenant.members.update', membersStore.member.id), { ...membersStore.member })
    }

    return useForm('post', route('tenant.members.store'), { ...membersStore.member })
})

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
        await form.value.submit().then(handleSuccess)
    } finally {
        loading.value = false
    }
}

// Compute the slideover title based on the member id
const modalTitle = computed(() => {
    return membersStore.member.id ? __('update member') : n__('add new', 0, { attribute: __('member') })
})

// Initialize a ref for the first input element
const firstInputRef = ref<HTMLElement>()

// Compute the slideover type based on the member id
const modalType = computed(() => {
    return membersStore.member.id ? 'update' : 'create'
})
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
                    class="[&[readonly]]:cursor-default [&[readonly]]:bg-white [&[readonly]]:dark:bg-darkmode-800"
                    onfocus="this.removeAttribute('readonly')"
                    readonly
                    type="email"
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
                    class="[&[readonly]]:cursor-default [&[readonly]]:bg-white [&[readonly]]:dark:bg-darkmode-800"
                    onfocus="this.removeAttribute('readonly')"
                    readonly
                    type="text"
                    @change="form.validate('phone')"
                    @keydown="allowOnlyNumbersOnKeyDown"
                />

                <div v-if="form.errors?.phone" class="mt-2">
                    <base-input-error :message="form.errors.phone"></base-input-error>
                </div>
            </div>
            <!-- End: Phone-->

            <template v-if="!membersStore.member.id">
                <!-- Begin: Password-->
                <div class="col-span-12 sm:col-span-6">
                    <base-form-label htmlFor="password">
                        {{ $t('validation.attributes.password') }}
                    </base-form-label>

                    <base-form-input
                        id="password"
                        v-model="form.password"
                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.password') })"
                        class="[&[readonly]]:cursor-default [&[readonly]]:bg-white [&[readonly]]:dark:bg-darkmode-800"
                        onfocus="this.removeAttribute('readonly')"
                        readonly
                        type="password"
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
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.password_confirmation')
                            })
                        "
                        class="[&[readonly]]:cursor-default [&[readonly]]:bg-white [&[readonly]]:dark:bg-darkmode-800"
                        onfocus="this.removeAttribute('readonly')"
                        readonly
                        type="password"
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

                <base-form-select
                    id="gender"
                    v-model="form.gender"
                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.gender') })"
                    @change="form.validate('gender')"
                >
                    <option value="male">{{ $t('male') }}</option>
                    <option value="female">{{ $t('female') }}</option>
                </base-form-select>

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

                <base-vue-select v-model:value="form.qualification" :options="qualifications"></base-vue-select>

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

                <base-vue-select
                    v-model:value="form.zone"
                    :options="zones"
                    label="name"
                    track-by="id"
                    @update:value="
                        (value) => {
                            form.zone_id = value.id
                            form.validate('zone_id')
                        }
                    "
                ></base-vue-select>

                <div v-if="form.errors?.zone_id" class="mt-2">
                    <base-input-error :message="form.errors.zone_id"></base-input-error>
                </div>
            </div>
            <!-- End: zone-->

            <!-- Begin: branch-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="branch">
                    {{ $t('validation.attributes.branch') }}
                </base-form-label>

                <base-vue-select
                    v-model:value="form.branch"
                    :options="branches"
                    label="name"
                    track-by="id"
                    @update:value="
                        (value) => {
                            form.branch_id = value.id
                            form.validate('branch_id')
                        }
                    "
                ></base-vue-select>

                <div v-if="form.errors?.branch_id" class="mt-2">
                    <base-input-error :message="form.errors.branch_id"></base-input-error>
                </div>
            </div>
            <!-- End: branch-->

            <!-- Begin: roles-->
            <div class="col-span-12 sm:col-span-6">
                <base-form-label htmlFor="roles">
                    {{ $t('validation.attributes.roles') }}
                </base-form-label>

                <base-vue-select
                    v-model="form.formatted_roles"
                    :options="roles"
                    label="name"
                    multiple
                    track-by="uuid"
                    @update:value="
                        (value) => {
                            form.roles = value.map((role: Role) => role.uuid)
                            form.validate('roles')
                        }
                    "
                ></base-vue-select>

                <div v-if="form.errors?.roles" class="mt-2">
                    <base-input-error :message="form.errors.roles"></base-input-error>
                </div>
            </div>
            <!-- End: roles-->
        </template>
    </create-edit-modal>
</template>
