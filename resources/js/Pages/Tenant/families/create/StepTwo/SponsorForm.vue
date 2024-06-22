<script setup lang="ts">
import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseLitePicker from '@/Components/Base/lite-picker/BaseLitePicker.vue'
import type { Form } from 'laravel-precognition-vue/dist/types'
import type { CreateFamilyForm } from '@/types/types'

defineProps<{ form?: Form<CreateFamilyForm> }>()

const firstName = defineModel('sponsor.first_name')

const lastName = defineModel('sponsor.last_name')

const phone = defineModel('sponsor.phone')

const fatherName = defineModel('sponsor.father_name')

const motherName = defineModel('sponsor.mother_name')

const birthCertificateNumber = defineModel('sponsor.birth_certificate_number')

const academicLevel = defineModel('sponsor.academic_level')

const job = defineModel('sponsor.function')

const healthStatus = defineModel('sponsor.health_status')

const diploma = defineModel('sponsor.diploma')

const cardNumber = defineModel('sponsor.card_number')

const birthDate = defineModel('sponsor.birth_date', { default: '' })
</script>

<template>
    <div class="grid grid-cols-12 gap-4 gap-y-5">
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
                @change="form?.validate('sponsor.first_name')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_first_name_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.first_name')"
                >
                    {{ form.errors['sponsor.first_name'] }}
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
                @change="form?.validate('sponsor.last_name')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_last_name_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.last_name')"
                >
                    {{ form.errors['sponsor.last_name'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="sponsor.birth_date">
                {{ $t('validation.attributes.sponsor.birth_date') }}
            </base-form-label>

            <base-lite-picker
                id="sponsor.birth_date"
                v-model="birthDate"
                :options="{
                        autoApply: false,
                        lang: 'ar',
                        showWeekNumbers: false,
                        format: 'DD-MM-YYYY',
                        dropdowns: {
                            minYear: 1930,
                            maxYear: null,
                            months: true,
                            years: true
                        }
                    }"
                class="block"
            ></base-lite-picker>

            <base-form-input-error>
                <div
                    data-test="error_start_date_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.birth_date')"
                >
                    {{ form.errors['sponsor.birth_date'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="phone_number">
                {{ $t('validation.attributes.phone_number') }}
            </base-form-label>

            <base-form-input
                v-model="phone"
                id="phone_number"
                type="text"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.phone_number')
                        })
                    "
                @change="form?.validate('sponsor.phone_number')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_phone_number_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.phone_number')"
                >
                    {{ form.errors['sponsor.phone_number'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="father_name">
                {{ $t('validation.attributes.father_name') }}
            </base-form-label>

            <base-form-input
                v-model="fatherName"
                id="father_name"
                type="text"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.father_name')
                        })
                    "
                @change="form?.validate('sponsor.father_name')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_father_name_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.father_name')"
                >
                    {{ form.errors['sponsor.father_name'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="mother_name">
                {{ $t('validation.attributes.mother_name') }}
            </base-form-label>

            <base-form-input
                v-model="motherName"
                id="mother_name"
                type="text"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.mother_name')
                        })
                    "
                @change="form?.validate('sponsor.mother_name')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_mother_name_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.mother_name')"
                >
                    {{ form.errors['sponsor.mother_name'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="birth_certificate_number">
                {{ $t('validation.attributes.birth_certificate_number') }}
            </base-form-label>

            <base-form-input
                v-model="birthCertificateNumber"
                id="birth_certificate_number"
                type="text"
                @keydown="allowOnlyNumbersOnKeyDown"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.birth_certificate_number')
                        })
                    "
                @change="form?.validate('sponsor.birth_certificate_number')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_birth_certificate_number_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.birth_certificate_number')"
                >
                    {{ form.errors['sponsor.birth_certificate_number'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="academic_level">
                {{ $t('validation.attributes.academic_level') }}
            </base-form-label>

            <base-form-input
                v-model="academicLevel"
                id="academic_level"
                type="text"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.academic_level')
                        })
                    "
                @change="form?.validate('sponsor.academic_level')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_academic_level_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.academic_level')"
                >
                    {{ form.errors['sponsor.academic_level'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="function">
                {{ $t('validation.attributes.function') }}
            </base-form-label>

            <base-form-input
                v-model="job"
                id="function"
                type="text"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.function')
                        })
                    "
                @change="form?.validate('sponsor.function')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_function_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.function')"
                >
                    {{ form.errors['sponsor.function'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="health_status">
                {{ $t('validation.attributes.health_status') }}
            </base-form-label>

            <base-form-input
                v-model="healthStatus"
                id="health_status"
                type="text"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.health_status')
                        })
                    "
                @change="form?.validate('sponsor.health_status')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_health_status_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.health_status')"
                >
                    {{ form.errors['sponsor.health_status'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="diploma">
                {{ $t('validation.attributes.diploma') }}
            </base-form-label>

            <base-form-input
                v-model="diploma"
                id="diploma"
                type="text"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.diploma')
                        })
                    "
                @change="form?.validate('sponsor.diploma')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_diploma_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.diploma')"
                >
                    {{ form.errors['sponsor.diploma'] }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="card_number">
                {{ $t('validation.attributes.card_number') }}
            </base-form-label>

            <base-form-input
                v-model="cardNumber"
                id="card_number"
                type="text"
                :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.card_number')
                        })
                    "
                @change="form?.validate('sponsor.card_number')"
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_card_number_message"
                    class="mt-2 text-danger"
                    v-if="form?.invalid('sponsor.card_number')"
                >
                    {{ form.errors['sponsor.card_number'] }}
                </div>
            </base-form-input-error>
        </div>

        <slot></slot>
    </div>
</template>
