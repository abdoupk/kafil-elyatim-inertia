<script setup lang="ts">
import type { RegistrationStepProps } from '@/types/types'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputGroup from '@/Components/Base/form/InputGroup/BaseInputGroup.vue'
import BaseInputGroupText from '@/Components/Base/form/InputGroup/BaseInputGroupText.vue'
import CitySelector from '@/Components/Global/CitySelector.vue'

defineProps<RegistrationStepProps>()

const hostname = '.' + new URL(import.meta.env.VITE_APP_URL).hostname

const association = defineModel('association')

const domain = defineModel('domain')

const address = defineModel('address')

const city = defineModel('city')

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
        <div class="text-base font-medium">{{ $t('auth.register.stepOne.title') }}</div>

        <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="association">
                    {{ $t('validation.attributes.association_name') }}
                </base-form-label>

                <base-form-input
                    autofocus
                    v-model="association"
                    id="association"
                    type="text"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.association_name')
                        })
                    "
                    @input="form?.validate('association')"
                ></base-form-input>

                <base-form-input-error>
                    <div
                        data-test="error_association_message"
                        class="mt-2 text-danger"
                        v-if="form?.invalid('association')"
                    >
                        {{ form.errors.association }}
                    </div>
                </base-form-input-error>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="domain">
                    {{ $t('validation.attributes.domain') }}
                </base-form-label>

                <base-input-group class="rtl:flex-row-reverse">
                    <base-form-input
                        class="!rounded-none !rounded-s"
                        @input="
                            (e) => {
                                updateDomainName(e)
                                form?.validate('domain')
                            }
                        "
                        @blur="blurDomainField"
                        v-model="domain"
                        id="domain"
                        type="text"
                        dir="ltr"
                        placeholder="el-baraka"
                    ></base-form-input>

                    <base-input-group-text class="rtl:!rounded-none rtl:!rounded-s">
                        <p dir="ltr">{{ hostname }}</p>
                    </base-input-group-text>
                </base-input-group>

                <base-form-input-error>
                    <div data-test="error_domain_message" class="mt-2 text-danger" v-if="form?.invalid('domain')">
                        {{ form.errors.domain }}
                    </div>
                </base-form-input-error>
            </div>
            <div class="intro-y col-span-12">
                <city-selector
                    @select:commune="
                        (e) => {
                            city = e
                            form?.validate('city')
                        }
                    "
                    :error-message="form?.errors.city"
                ></city-selector>
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

            <slot></slot>
        </div>
    </div>
</template>
