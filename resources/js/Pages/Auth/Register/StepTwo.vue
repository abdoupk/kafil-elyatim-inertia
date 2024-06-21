<script setup lang="ts">
import type { RegistrationStepProps } from '@/types/types'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'

import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'

defineProps<RegistrationStepProps>()

const firstName = defineModel('first_name')

const lastName = defineModel('last_name')

const phone = defineModel('phone')

const email = defineModel('email')

const password = defineModel('password')

const passwordConfirmation = defineModel('password_confirmation')
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
        v-if="currentStep === 2"
    >
        <div class="text-base font-medium">
            {{ $t('auth.register.stepTwo.title') }}
        </div>

        <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="first_name">
                    {{ $t('validation.attributes.first_name') }}
                </base-form-label>

                <base-form-input
                    autofocus
                    v-model="firstName"
                    id="first_name"
                    type="text"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.first_name')
                        })
                    "
                    @change="form?.validate('first_name')"
                ></base-form-input>

                <base-form-input-error>
                    <div
                        data-test="error_first_name_message"
                        class="mt-2 text-danger"
                        v-if="form?.invalid('first_name')"
                    >
                        {{ form.errors.first_name }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="last_name">
                    {{ $t('validation.attributes.last_name') }}
                </base-form-label>

                <base-form-input
                    v-model="lastName"
                    id="last_name"
                    type="text"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.last_name')
                        })
                    "
                    @change="form?.validate('last_name')"
                ></base-form-input>

                <base-form-input-error>
                    <div data-test="error_last_name_message" class="mt-2 text-danger" v-if="form?.invalid('last_name')">
                        {{ form.errors.last_name }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="email">
                    {{ $t('validation.attributes.email') }}
                </base-form-label>

                <base-form-input
                    class="rtl:placeholder:text-right [&[readonly]]:cursor-default [&[readonly]]:bg-slate-100 [&[readonly]]:dark:bg-darkmode-800"
                    autocomplete="off"
                    aria-autocomplete="none"
                    readonly
                    onfocus="this.removeAttribute('readonly')"
                    v-model="email"
                    dir="ltr"
                    id="email"
                    type="text"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.email')
                        })
                    "
                    @change="form?.validate('email')"
                ></base-form-input>

                <base-form-input-error>
                    <div data-test="error_email_message" class="mt-2 text-danger" v-if="form?.invalid('email')">
                        {{ form.errors.email }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="phone">
                    {{ $t('validation.attributes.phone') }}
                </base-form-label>

                <base-form-input
                    class="rtl:placeholder:text-right"
                    v-model="phone"
                    id="phone"
                    type="tel"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    maxlength="10"
                    dir="ltr"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.phone')
                        })
                    "
                    @change="form?.validate('phone')"
                ></base-form-input>

                <base-form-input-error>
                    <div data-test="error_phone_message" class="mt-2 text-danger" v-if="form?.invalid('phone')">
                        {{ form.errors.phone }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="password">
                    {{ $t('validation.attributes.password') }}
                </base-form-label>

                <base-form-input
                    class="[&[readonly]]:cursor-default [&[readonly]]:bg-slate-100 [&[readonly]]:dark:bg-darkmode-800"
                    readonly
                    onfocus="this.removeAttribute('readonly')"
                    v-model="password"
                    id="password"
                    type="password"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.password')
                        })
                    "
                    @change="form?.validate('password')"
                ></base-form-input>

                <base-form-input-error>
                    <div data-test="error_password_message" class="mt-2 text-danger" v-if="form?.invalid('password')">
                        {{ form.errors.password }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="password_confirmation">
                    {{ $t('validation.attributes.password_confirmation') }}
                </base-form-label>

                <base-form-input
                    class="[&[readonly]]:cursor-default [&[readonly]]:bg-slate-100 [&[readonly]]:dark:bg-darkmode-800"
                    v-model="passwordConfirmation"
                    id="password_confirmation"
                    type="password"
                    readonly
                    onfocus="this.removeAttribute('readonly')"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.password_confirmation')
                        })
                    "
                    @change="form?.validate('password_confirmation')"
                ></base-form-input>

                <base-form-input-error>
                    <div class="mt-2 text-danger" v-if="form?.invalid('password_confirmation')">
                        {{ form.errors.password_confirmation }}
                    </div>
                </base-form-input-error>
            </div>

            <slot></slot>
        </div>
    </div>
</template>
