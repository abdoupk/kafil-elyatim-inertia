<script setup lang="ts">
import type { CreateFamilyForm } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseLitePicker from '@/Components/Base/lite-picker/BaseLitePicker.vue'

defineProps<{ form: Form<CreateFamilyForm> }>()

const firstName = defineModel('first_name')

const lastName = defineModel('last_name')

const birthDate = defineModel('birthDate', { default: '' })

const deathDate = defineModel('deathDate', { default: '' })

const income = defineModel('income')

const job = defineModel('job')
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
                @change="
                    form?.validate(
                        //@ts-ignore
                        'spouse.first_name'
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
                            'spouse.first_name'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['spouse.first_name']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="last_name">
                {{ $t('validation.attributes.last_name') }}
            </base-form-label>

            <base-form-input
                autofocus
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
                        'spouse.last_name'
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
                            'spouse.last_name'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['spouse.last_name']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="birth_date">
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
                    data-test="error_birth_date_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'spouse.birth_date'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['spouse.birth_date']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="death_date">
                {{ $t('validation.attributes.spouse.death_date') }}
            </base-form-label>

            <base-lite-picker
                id="sponsor.death_date"
                v-model="deathDate"
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
                    data-test="error_death_date_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'spouse.death_date'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['spouse.death_date']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="function">
                {{ $t('validation.attributes.spouse.function') }}
            </base-form-label>

            <base-form-input
                autofocus
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
                        'spouse.function'
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
                            'spouse.function'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['spouse.function']
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="income">
                {{ $t('validation.attributes.spouse.income') }}
            </base-form-label>

            <base-form-input
                autofocus
                v-model="income"
                id="income"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.income')
                    })
                "
                @change="
                    form?.validate(
                        //@ts-ignore
                        'spouse.income'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    data-test="error_income_message"
                    class="mt-2 text-danger"
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'spouse.income'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['spouse.income']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>
</template>
