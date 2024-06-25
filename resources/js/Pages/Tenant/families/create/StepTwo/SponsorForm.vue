<script setup lang="ts">
import type { CreateFamilyForm } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseLitePicker from '@/Components/Base/lite-picker/BaseLitePicker.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'

defineProps<{ form?: Form<CreateFamilyForm> }>()

const firstName = defineModel('first_name')

const lastName = defineModel('last_name')

const phone = defineModel('phone')

const fatherName = defineModel('father_name')

const motherName = defineModel('mother_name')

const birthCertificateNumber = defineModel('birth_certificate_number')

const academicLevel = defineModel('academic_level')

const job = defineModel('function')

const healthStatus = defineModel('health_status')

const diploma = defineModel('diploma')

const cardNumber = defineModel('card_number')

const birthDate = defineModel('birth_date', { default: '' })
</script>

<template>
    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-6">
        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="card_number">
                {{ $t('validation.attributes.sponsor.card_number') }}
            </base-form-label>

            <base-form-input
                v-model="cardNumber"
                id="card_number"
                @keydown="allowOnlyNumbersOnKeyDown"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.card_number')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.card_number'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_card_number_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.card_number'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.card_number']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="sponsor.birth_date">
                {{ $t('validation.attributes.sponsor.birth_date') }}
            </base-form-label>
            <div class="relative">
                <div
                    class="absolute flex items-center justify-center w-10 h-full border rounded-s bg-slate-100 text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"
                >
                    <svg-loader name="icon-calendar" class="w-4 h-4 fill-current" />
                </div>

                <base-lite-picker
                    @keydown.prevent
                    id="sponsor.birth_date"
                    :placeholder="
                        $t('auth.placeholders.fill', { attribute: $t('validation.attributes.date_of_birth') })
                    "
                    :options="{ format: 'DD-MM-YYYY' }"
                    v-model="birthDate"
                    class="block ps-12"
                ></base-lite-picker>
            </div>
            <base-form-input-error>
                <div
                    data-test="error_start_date_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.birth_date'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.birth_date']
                    }}
                </div>
            </base-form-input-error>
        </div>

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
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.first_name'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_first_name_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.first_name'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.first_name']
                    }}
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
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.last_name'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_last_name_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.last_name'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.last_name']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="phone_number">
                {{ $t('validation.attributes.phone') }}
            </base-form-label>

            <base-form-input
                v-model="phone"
                id="phone_number"
                @keydown="allowOnlyNumbersOnKeyDown"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.phone')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.phone_number'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_phone_number_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.phone_number'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.phone_number']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="father_name">
                {{ $t('validation.attributes.sponsor.father_name') }}
            </base-form-label>

            <base-form-input
                v-model="fatherName"
                id="father_name"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.father_name')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.father_name'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_father_name_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.father_name'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.father_name']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="mother_name">
                {{ $t('validation.attributes.sponsor.mother_name') }}
            </base-form-label>

            <base-form-input
                v-model="motherName"
                id="mother_name"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.mother_name')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.mother_name'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_mother_name_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.mother_name'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.mother_name']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="birth_certificate_number">
                {{ $t('validation.attributes.sponsor.birth_certificate_number') }}
            </base-form-label>

            <base-form-input
                v-model="birthCertificateNumber"
                id="birth_certificate_number"
                type="text"
                @keydown="allowOnlyNumbersOnKeyDown"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.birth_certificate_number')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.birth_certificate_number'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_birth_certificate_number_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.birth_certificate_number'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.birth_certificate_number']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="academic_level">
                {{ $t('validation.attributes.sponsor.academic_level') }}
            </base-form-label>

            <base-form-input
                v-model="academicLevel"
                id="academic_level"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.academic_level')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.academic_level'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_academic_level_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.academic_level'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.academic_level']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="function">
                {{ $t('validation.attributes.sponsor.function') }}
            </base-form-label>

            <base-form-input
                v-model="job"
                id="function"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.function')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.function'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_function_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.function'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.function']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="health_status">
                {{ $t('validation.attributes.sponsor.health_status') }}
            </base-form-label>

            <base-form-input
                v-model="healthStatus"
                id="health_status"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.health_status')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.health_status'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_health_status_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.health_status'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.health_status']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="diploma">
                {{ $t('validation.attributes.sponsor.diploma') }}
            </base-form-label>

            <base-form-input
                v-model="diploma"
                id="diploma"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.diploma')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.diploma'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_diploma_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.diploma'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.diploma']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <slot></slot>
    </div>
</template>
