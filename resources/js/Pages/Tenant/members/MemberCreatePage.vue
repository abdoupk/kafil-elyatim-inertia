<script lang="ts" setup>
import type { Branch, Role, Zone } from '@/types/types'

import { useForm } from 'laravel-precognition-vue'
import { computed } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { createMemberFormAttribute } from '@/utils/constants'
import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'

defineOptions({
    layout: TheLayout
})

defineProps<{
    qualifications: string[]
    branches: Branch[]
    roles: Role[]
    zones: Zone[]
}>()

const form = useForm('post', route('tenant.members.store'), { ...createMemberFormAttribute })

const rolesErrors = computed(() => {
    let regx = new RegExp('^roles')

    return Object.keys(form.errors).filter((error) => regx.test(error))
})
</script>

<template>
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-base font-medium">Display Information</h2>
        </div>

        <form @submit.prevent="form.submit()">
            <div class="grid grid-cols-12 gap-4 gap-y-3 p-5">
                <!-- Begin: First name-->
                <div class="col-span-12 sm:col-span-6">
                    <base-form-label htmlFor="first_name">
                        {{ $t('validation.attributes.first_name') }}
                    </base-form-label>

                    <base-form-input
                        id="first_name"
                        ref="firstInputRef"
                        v-model="form.first_name"
                        :placeholder="
                            $t('auth.placeholders.fill', { attribute: $t('validation.attributes.first_name') })
                        "
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
                        :placeholder="
                            $t('auth.placeholders.fill', { attribute: $t('validation.attributes.last_name') })
                        "
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

                    <div>
                        <!--                        <base-tom-select-->
                        <!--                            v-model="form.qualification"-->
                        <!--                            :options="{ maxOptions: 200 }"-->
                        <!--                            :placeholder="-->
                        <!--                                $t('auth.placeholders.fill', { attribute: $t('validation.attributes.qualification') })-->
                        <!--                            "-->
                        <!--                            class="h-full w-full"-->
                        <!--                            @update:modelValue="updateQualification"-->
                        <!--                        >-->
                        <!--                            <option v-for="qualification in qualifications" :key="qualification" :value="qualification">-->
                        <!--                                {{ qualification }}-->
                        <!--                            </option>-->
                        <!--                        </base-tom-select>-->
                        <!--                        <base-vue-select></base-vue-select>-->
                    </div>

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

                    <div>
                        <!--                        <base-tom-select-->
                        <!--                            v-model="form.zone_id"-->
                        <!--                            :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.zone') })"-->
                        <!--                            class="h-full w-full"-->
                        <!--                            @update:modelValue="updateZone"-->
                        <!--                        >-->
                        <!--                            <option v-for="role in zones" :key="role.id" :value="role.id">-->
                        <!--                                {{ role.name }}-->
                        <!--                            </option>-->
                        <!--                        </base-tom-select>-->
                        <!--                        <base-vue-select></base-vue-select>-->
                    </div>

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

                    <div>
                        <!--                        <base-tom-select-->
                        <!--                            v-model="form.branch_id"-->
                        <!--                            :options="{ maxOptions: 200 }"-->
                        <!--                            :placeholder="-->
                        <!--                                $t('auth.placeholders.fill', { attribute: $t('validation.attributes.branch') })-->
                        <!--                            "-->
                        <!--                            class="h-full w-full"-->
                        <!--                            @update:modelValue="updateBranch"-->
                        <!--                        >-->
                        <!--                            <option v-for="branch in branches" :key="branch.id" :value="branch.id">-->
                        <!--                                {{ branch.name }}-->
                        <!--                            </option>-->
                        <!--                        </base-tom-select>-->

                        <!--                        <base-vue-select></base-vue-select>-->
                    </div>

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

                    <div>
                        <!--                        <base-tom-select-->
                        <!--                            v-model="form.roles"-->
                        <!--                            :options="{ maxOptions: 200 }"-->
                        <!--                            :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.zone') })"-->
                        <!--                            class="h-full w-full"-->
                        <!--                            multiple-->
                        <!--                            @update:modelValue="updateRoles"-->
                        <!--                        >-->
                        <!--                            <option v-for="role in roles" :key="role.uuid" :value="role.uuid">-->
                        <!--                                {{ role.name }}-->
                        <!--                            </option>-->
                        <!--                        </base-tom-select>-->
                        {{ form.roles }}
                        <base-vue-select
                            :options="[
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options',
                                'list',
                                'of',
                                'options'
                            ]"
                            v-model:value="form.roles"
                        ></base-vue-select>
                    </div>

                    <div v-if="rolesErrors" class="mt-2">
                        <!-- @vue-expect-error -->
                        <base-input-error :message="form.errors[rolesErrors[0]]"></base-input-error>
                    </div>
                </div>
                <!-- End: roles-->
            </div>

            <div class="p-5 w-1/6">
                <base-v-calendar></base-v-calendar>
            </div>

            <div class="flex justify-end px-5 py-3">
                <base-button class="w-20 me-1" type="button" variant="outline-secondary">
                    {{ $t('cancel') }}
                </base-button>

                <base-button :disabled="form.processing" class="w-20" type="submit" variant="primary">
                    <spinner-button-loader :show="form.processing"></spinner-button-loader>

                    {{ $t('create') }}
                </base-button>
            </div>
        </form>
    </div>
</template>
