<script setup lang="ts">
import type { CreateFamilyStepProps } from '@/types/types'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseLitePicker from '@/Components/Base/lite-picker/BaseLitePicker.vue'
import BaseTomSelect from '@/Components/Base/tom-select/BaseTomSelect.vue'

import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'

const props = defineProps<CreateFamilyStepProps>()

const zone = defineModel('zone', { default: '' })

const branch = defineModel('branch', { default: '' })

const startDate = defineModel('startDate', { default: '' })

const address = defineModel('address')

const fileNumber = defineModel('fileNumber')

const setZone = (value: string | string[]) => {
    if (typeof value === 'string') {
        zone.value = value

        props.form?.validate('zone_id')
    }
}

const setBranch = (value: string | string[]) => {
    if (typeof value === 'string') {
        branch.value = value

        props.form?.validate('branch_id')
    }
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
                    v-model="fileNumber"
                    id="file_number"
                    type="text"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('file_number')
                        })
                    "
                    @keydown="allowOnlyNumbersOnKeyDown"
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
                    {{ $t('validation.attributes.starting_sponsorship_date') }}
                </base-form-label>

                <base-lite-picker
                    @keydown.prevent
                    v-model="startDate"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('validation.attributes.starting_sponsorship_date')
                        })
                    "
                    :options="{ format: 'DD-MM-YYYY' }"
                    class="block w-1/2"
                ></base-lite-picker>

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
                <base-form-label for="branch">
                    {{ $t('validation.attributes.branch') }}
                </base-form-label>

                <div>
                    <base-tom-select
                        :model-value="branch"
                        :data-placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_branch') })"
                        @update:model-value="setBranch"
                    >
                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                            {{ branch.name }}
                        </option>
                    </base-tom-select>
                </div>

                <base-form-input-error>
                    <div class="mt-2 text-danger" v-if="form?.invalid('branch_id')" data-test="error_branch_message">
                        {{ form.errors.branch_id }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="zone">
                    {{ $t('validation.attributes.zone') }}
                </base-form-label>

                <div>
                    <base-tom-select
                        :model-value="zone"
                        :data-placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_zone') })"
                        @update:model-value="setZone"
                    >
                        <option v-for="zone in zones" :key="zone.id" :value="zone.id">{{ zone.name }}</option>
                    </base-tom-select>
                </div>

                <base-form-input-error>
                    <div class="mt-2 text-danger" v-if="form?.invalid('zone_id')" data-test="error_zone_message">
                        {{ form.errors.zone_id }}
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

            <slot></slot>
        </div>
    </div>
</template>
