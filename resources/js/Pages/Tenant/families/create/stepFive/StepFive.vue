<script setup lang="ts">
import type { CreateFamilyStepProps } from '@/types/types'

import BaseClassicEditor from '@/Components/Base/editor/BaseClassicEditor.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseLitePicker from '@/Components/Base/lite-picker/BaseLitePicker.vue'
import BaseTomSelect from '@/Components/Base/tom-select/BaseTomSelect.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<CreateFamilyStepProps>()

const report = defineModel('report', { default: '' })

const previewDate = defineModel('previewDate', { default: '' })

const InspectorsMembers = defineModel('InspectorsMembers', { default: [] })

const setInspectorsMembers = (value: string | string[]) => {
    // @ts-ignore
    InspectorsMembers.value = value

    props.form?.validate('inspectors_members')
}
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
        v-if="currentStep === 5"
    >
        <div class="text-base font-medium">
            {{ $t('auth.register.stepOne.title') }}
        </div>

        <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
            <div class="intro-y col-span-12">
                <base-form-label for="report">
                    {{ $t('the_report') }}
                </base-form-label>

                <base-classic-editor id="report" :model-value="report"></base-classic-editor>

                <base-form-input-error>
                    <div data-test="error_report_message" class="mt-2 text-danger" v-if="form?.invalid('report')">
                        {{ form.errors.report }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="preview_date">
                    {{ $t('validation.attributes.starting_sponsorship_date') }}
                </base-form-label>
                <div class="relative">
                    <div
                        class="absolute flex items-center justify-center w-10 h-full border rounded-s bg-slate-100 text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"
                    >
                        <svg-loader name="icon-calendar" class="w-4 h-4 fill-current" />
                    </div>

                    <base-lite-picker
                        id="preview_date"
                        v-model="previewDate"
                        :options="{
                            format: 'DD-MM-YYYY',
                            dropdowns: {
                                minYear: 2010,
                                maxYear: null,
                                months: true,
                                years: true
                            }
                        }"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.starting_sponsorship_date')
                            })
                        "
                        class="block w-1/2 ps-12"
                    ></base-lite-picker>
                </div>
                <base-form-input-error>
                    <div
                        data-test="error_preview_date_message"
                        class="mt-2 text-danger"
                        v-if="form?.invalid('preview_date')"
                    >
                        {{ form.errors.preview_date }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 sm:col-span-6">
                <base-form-label for="inspectors_members">
                    {{ $t('inspectors_members') }}
                </base-form-label>

                <div>
                    <base-tom-select
                        multiple
                        :options="{ create: false }"
                        :model-value="InspectorsMembers"
                        :data-placeholder="$t('auth.placeholders.tomselect', { attribute: $t('inspectors_members') })"
                        @update:model-value="setInspectorsMembers"
                    >
                        <option value=""></option>
                        <option v-for="member in members" :key="member.id" :value="member.id">{{ member.name }}</option>
                    </base-tom-select>
                </div>

                <base-form-input-error>
                    <div
                        class="mt-2 text-danger"
                        v-if="form?.invalid('inspectors_members')"
                        data-test="error_inspectors_members_message"
                    >
                        {{ form.errors.inspectors_members }}
                    </div>
                </base-form-input-error>
            </div>
        </div>

        <slot></slot>
    </div>
</template>
