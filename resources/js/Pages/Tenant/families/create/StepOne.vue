<script setup lang="ts">
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseLitePicker from '@/Components/Base/lite-picker/BaseLitePicker.vue'
import type { RegistrationStepProps } from '@/types/types'

defineProps<RegistrationStepProps>()

const association = defineModel('association')

const domain = defineModel('domain')

const address = defineModel('address')

const city = defineModel('city', { default: '' })

const blurDomainField = (event: Event) => {
    let str = (event.target as HTMLInputElement).value

    domain.value = str.endsWith('-') ? str.slice(0, -1) + '' : str
}

const updateDomainName = (event: Event) => {
    let str = (event.target as HTMLInputElement).value

    str = str.replace(/[^a-zA-Z0-9\s-]|^[0-9]+|([a-zA-Z-])[0-9]+(?=[a-zA-Z-\s])/g, '$1')

    str = str.replace(/\s+/g, '-')

    str = str.replace(/--+|^-+/g, '-')

    str = str.replace(/(-[0-9]+)+$/g, '$1')

    domain.value = str.replace(/-(?=\d+)/g, '')
}
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
        v-if="currentStep === 1"
    >
        <div class="text-base font-medium">
            {{ $t('auth.register.stepOne.title') }}
        </div>

        <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="file_number">
                    {{ $t('validation.attributes.file_number') }}
                </base-form-label>

                <base-form-input
                    autofocus
                    v-model="file_number"
                    id="file_number"
                    type="text"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('file_number')
                        })
                    "
                    @input="form?.validate('file_number')"
                ></base-form-input>

                <base-form-input-error>
                    <div
                        data-test="error_file_number_message"
                        class="mt-2 text-danger"
                        v-if="form?.invalid('file_number')"
                    >
                        {{ form.errors.file_number }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="start_date">
                    {{ $t('validation.attributes.start_date_name') }}
                </base-form-label>

                <base-form-input
                    autofocus
                    v-model="start_date"
                    id="start_date"
                    type="text"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('starting_sponsorship_date')
                        })
                    "
                    @input="form?.validate('start_date')"
                ></base-form-input>

                <base-form-input-error>
                    <div
                        data-test="error_start_date_message"
                        class="mt-2 text-danger"
                        v-if="form?.invalid('start_date')"
                    >
                        {{ form.errors.start_date }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="address">
                    {{ $t('validation.attributes.address') }}
                </base-form-label>
                <base-form-input
                    v-model="address"
                    type="text"
                    id="address"
                    placeholder="حي الحياة تجزئة ب رقم '89' البيض"
                    @input="form?.validate('address')"
                ></base-form-input>
                <base-form-input-error>
                    <div class="mt-2 text-danger" v-if="form?.invalid('address')" data-test="error_address_message">
                        {{ form.errors.address }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="zone">
                    {{ $t('validation.attributes.zone') }}
                </base-form-label>

                <base-lite-picker
                    v-model="city"
                    :options="{
                        autoApply: false,
                        lang: 'ar',
                        showWeekNumbers: false,
                        dropdowns: {
                            minYear: 1990,
                            maxYear: null,
                            months: true,
                            years: true
                        }
                    }"
                ></base-lite-picker>

                <base-form-input-error>
                    <div class="mt-2 text-danger" v-if="form?.invalid('zone')" data-test="error_zone_message">
                        {{ form.errors.zone }}
                    </div>
                </base-form-input-error>
            </div>

            <slot></slot>
        </div>
    </div>
</template>
