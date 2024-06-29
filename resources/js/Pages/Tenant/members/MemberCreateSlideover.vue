<script lang="ts" setup>
// Define props
import type { Branch, Role, Zone } from '@/types/types'

import { useMembersStore } from '@/stores/members'
import { router } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'

import CreateEditSlideOver from '@/Pages/Shared/CreateEditSlideOver.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseTomSelect from '@/Components/Base/tom-select/BaseTomSelect.vue'

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

const updateQualification = (qualification: string | string[]) => {
    if (typeof qualification === 'string') {
        form.value.qualification = qualification

        form.value.validate('qualification')
    }
}

const updateBranch = (branch_id: string | string[]) => {
    if (typeof branch_id === 'string') {
        form.value.branch_id = branch_id

        form.value.validate('branch_id')
    }
}

const updateZone = (zone_id: string | string[]) => {
    if (typeof zone_id === 'string') {
        form.value.zone_id = zone_id

        form.value.validate('zone_id')
    }
}

const updateRoles = (roles: string | string[]) => {
    if (typeof roles !== 'string') {
        form.value.roles = roles

        form.value.validate('roles')
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
    <create-edit-slide-over
        :focusable-input="firstInputRef"
        :loading="loading"
        :open="open"
        :slideover-type="slideoverType"
        :title="slideoverTitle"
        size="xl"
        @close="emit('close')"
        @handle-submit="handleSubmit"
    >
        <template #description>
            <!--            &lt;!&ndash; Begin: First name&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="first_name">-->
            <!--                    {{ $t('validation.attributes.first_name') }}-->
            <!--                </base-form-label>-->

            <!--                <base-form-input-->
            <!--                    id="first_name"-->
            <!--                    ref="firstInputRef"-->
            <!--                    v-model="form.first_name"-->
            <!--                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.first_name') })"-->
            <!--                    type="text"-->
            <!--                    @change="form.validate('first_name')"-->
            <!--                />-->

            <!--                <div v-if="form.errors?.first_name" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.first_name"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: First name&ndash;&gt;-->

            <!--            &lt;!&ndash; Begin: Last name&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="last_name">-->
            <!--                    {{ $t('validation.attributes.last_name') }}-->
            <!--                </base-form-label>-->

            <!--                <base-form-input-->
            <!--                    id="last_name"-->
            <!--                    v-model="form.last_name"-->
            <!--                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.last_name') })"-->
            <!--                    type="text"-->
            <!--                    @change="form.validate('last_name')"-->
            <!--                />-->

            <!--                <div v-if="form.errors?.last_name" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.last_name"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: Last name&ndash;&gt;-->

            <!--            &lt;!&ndash; Begin: Email&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="email">-->
            <!--                    {{ $t('validation.attributes.email') }}-->
            <!--                </base-form-label>-->

            <!--                <base-form-input-->
            <!--                    id="email"-->
            <!--                    v-model="form.email"-->
            <!--                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.email') })"-->
            <!--                    type="text"-->
            <!--                    @change="form.validate('email')"-->
            <!--                />-->

            <!--                <div v-if="form.errors?.email" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.email"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: Email&ndash;&gt;-->

            <!--            &lt;!&ndash; Begin: Phone&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="phone">-->
            <!--                    {{ $t('validation.attributes.phone') }}-->
            <!--                </base-form-label>-->

            <!--                <base-form-input-->
            <!--                    id="phone"-->
            <!--                    v-model="form.phone"-->
            <!--                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.phone') })"-->
            <!--                    type="text"-->
            <!--                    @change="form.validate('phone')"-->
            <!--                />-->

            <!--                <div v-if="form.errors?.phone" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.phone"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: Phone&ndash;&gt;-->

            <!--            <template v-if="slideoverType === 'create'">-->
            <!--                &lt;!&ndash; Begin: Password&ndash;&gt;-->
            <!--                <div class="col-span-12 sm:col-span-6">-->
            <!--                    <base-form-label htmlFor="password">-->
            <!--                        {{ $t('validation.attributes.password') }}-->
            <!--                    </base-form-label>-->

            <!--                    <base-form-input-->
            <!--                        id="password"-->
            <!--                        v-model="form.password"-->
            <!--                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.password') })"-->
            <!--                        type="text"-->
            <!--                        @change="form.validate('password')"-->
            <!--                    />-->

            <!--                    <div v-if="form.errors?.password" class="mt-2">-->
            <!--                        <base-input-error :message="form.errors.password"></base-input-error>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                &lt;!&ndash; End: Password&ndash;&gt;-->

            <!--                &lt;!&ndash; Begin: Password Confirmation&ndash;&gt;-->
            <!--                <div class="col-span-12 sm:col-span-6">-->
            <!--                    <base-form-label htmlFor="password_confirmation">-->
            <!--                        {{ $t('validation.attributes.password_confirmation') }}-->
            <!--                    </base-form-label>-->

            <!--                    <base-form-input-->
            <!--                        id="password_confirmation"-->
            <!--                        v-model="form.password_confirmation"-->
            <!--                        :placeholder="-->
            <!--                            $t('auth.placeholders.fill', {-->
            <!--                                attribute: $t('validation.attributes.password_confirmation')-->
            <!--                            })-->
            <!--                        "-->
            <!--                        type="text"-->
            <!--                        @change="form.validate('password_confirmation')"-->
            <!--                    />-->

            <!--                    <div v-if="form.errors?.password_confirmation" class="mt-2">-->
            <!--                        <base-input-error :message="form.errors.password_confirmation"></base-input-error>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                &lt;!&ndash; End: Password Confirmation&ndash;&gt;-->
            <!--            </template>-->

            <!--            &lt;!&ndash; Begin: gender&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="gender">-->
            <!--                    {{ $t('validation.attributes.gender') }}-->
            <!--                </base-form-label>-->

            <!--                <base-form-select-->
            <!--                    id="gender"-->
            <!--                    v-model="form.gender"-->
            <!--                    :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.gender') })"-->
            <!--                    type="text"-->
            <!--                    @change="form.validate('gender')"-->
            <!--                >-->
            <!--                    <option value="male">{{ $t('male') }}</option>-->
            <!--                    <option value="female">{{ $t('female') }}</option>-->
            <!--                </base-form-select>-->

            <!--                <div v-if="form.errors?.gender" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.gender"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: gender&ndash;&gt;-->

            <!--            &lt;!&ndash; Begin: qualification&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="qualification">-->
            <!--                    {{ $t('validation.attributes.qualification') }}-->
            <!--                </base-form-label>-->

            <!--                <div>-->
            <!--                    <base-tom-select-->
            <!--                        id="qualification"-->
            <!--                        v-model="form.qualification"-->
            <!--                        :options="{ maxOptions: 200 }"-->
            <!--                        :placeholder="-->
            <!--                            $t('auth.placeholders.fill', { attribute: $t('validation.attributes.qualification') })-->
            <!--                        "-->
            <!--                        class="h-full w-full"-->
            <!--                        @update:modelValue="updateQualification"-->
            <!--                    >-->
            <!--                        <option v-for="qualification in qualifications" :key="qualification" :value="qualification">-->
            <!--                            {{ qualification }}-->
            <!--                        </option>-->
            <!--                    </base-tom-select>-->
            <!--                </div>-->

            <!--                <div v-if="form.errors?.qualification" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.qualification"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: qualification&ndash;&gt;-->

            <!--            &lt;!&ndash; Begin: zone&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="zone">-->
            <!--                    {{ $t('validation.attributes.zone') }}-->
            <!--                </base-form-label>-->

            <!--                <div>-->
            <!--                    <base-tom-select-->
            <!--                        id="zone"-->
            <!--                        v-model="form.zone_id"-->
            <!--                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.roles') })"-->
            <!--                        class="h-full w-full"-->
            <!--                        @update:modelValue="updateZone"-->
            <!--                    >-->
            <!--                        <option v-for="role in zones" :key="role.id" :value="role.id">-->
            <!--                            {{ role.name }}-->
            <!--                        </option>-->
            <!--                    </base-tom-select>-->
            <!--                </div>-->

            <!--                <div v-if="form.errors?.zone" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.zone"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: zone&ndash;&gt;-->

            <!--            &lt;!&ndash; Begin: branch&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="branch">-->
            <!--                    {{ $t('validation.attributes.branch') }}-->
            <!--                </base-form-label>-->

            <!--                <div>-->
            <!--                    <base-tom-select-->
            <!--                        id="branch"-->
            <!--                        v-model="form.branch_id"-->
            <!--                        :options="{ maxOptions: 200 }"-->
            <!--                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.branch') })"-->
            <!--                        class="h-full w-full"-->
            <!--                        @update:modelValue="updateBranch"-->
            <!--                    >-->
            <!--                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">-->
            <!--                            {{ branch.name }}-->
            <!--                        </option>-->
            <!--                    </base-tom-select>-->
            <!--                </div>-->

            <!--                <div v-if="form.errors?.branch" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.branch"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: branch&ndash;&gt;-->

            <!--            &lt;!&ndash; Begin: roles&ndash;&gt;-->
            <!--            <div class="col-span-12 sm:col-span-6">-->
            <!--                <base-form-label htmlFor="roles">-->
            <!--                    {{ $t('validation.attributes.roles') }}-->
            <!--                </base-form-label>-->

            <!--                <div>-->
            <!--                    <base-tom-select-->
            <!--                        id="roles"-->
            <!--                        v-model="form.role_id"-->
            <!--                        :options="{ maxOptions: 200 }"-->
            <!--                        :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.zone') })"-->
            <!--                        class="h-full w-full"-->
            <!--                        @update:modelValue="updateRoles"-->
            <!--                    >-->
            <!--                        <option v-for="role in roles" :key="role.id" :value="role.id">-->
            <!--                            {{ role.name }}-->
            <!--                        </option>-->
            <!--                    </base-tom-select>-->
            <!--                </div>-->

            <!--                <div v-if="form.errors?.roles" class="mt-2">-->
            <!--                    <base-input-error :message="form.errors.roles"></base-input-error>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            &lt;!&ndash; End: roles&ndash;&gt;-->
        </template>
    </create-edit-slide-over>
</template>
