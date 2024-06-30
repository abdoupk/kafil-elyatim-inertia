<script lang="ts" setup>
import type { CreateFamilyStepProps } from '@/types/types'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseClassicEditor from '@/Components/Base/editor/BaseClassicEditor.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

defineProps<CreateFamilyStepProps>()

const report = defineModel('report', { default: '' })

const previewDate = defineModel('previewDate', { default: '' })

const inspectorsMembers = defineModel('inspectorsMembers', { default: [] })
</script>

<template>
    <div
        v-if="currentStep === 5"
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
    >
        <div class="text-base font-medium">
            {{ $t('auth.register.stepOne.title') }}
        </div>

        <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
            <div class="col-span-12">
                <base-form-label for="report">
                    {{ $t('the_report') }}
                </base-form-label>

                <base-classic-editor
                    id="report"
                    v-model="report"
                    @blur="form?.validate('report')"
                ></base-classic-editor>

                <base-form-input-error>
                    <div v-if="form?.invalid('report')" class="mt-2 text-danger" data-test="error_report_message">
                        {{ form.errors.report }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="col-span-12 sm:col-span-8">
                <base-form-label for="inspectors_members">
                    {{ $t('inspectors_members') }}
                </base-form-label>

                <div>
                    <base-vue-select
                        :options="members"
                        :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_branch') })"
                        label="name"
                        track-by="name"
                        @update:value="
                            (value) => {
                                inspectorsMembers = value

                                form?.validate('inspectors_members')
                            }
                        "
                    ></base-vue-select>
                </div>

                <base-form-input-error>
                    <div
                        v-if="form?.invalid('inspectors_members')"
                        class="mt-2 text-danger"
                        data-test="error_inspectors_members_message"
                    >
                        {{ form.errors.inspectors_members }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="col-span-12 sm:col-span-4">
                <base-form-label for="preview_date">
                    {{ $t('preview_date') }}
                </base-form-label>

                <base-v-calendar v-model:date="previewDate"></base-v-calendar>

                <base-form-input-error>
                    <div
                        v-if="form?.invalid('preview_date')"
                        class="mt-2 text-danger"
                        data-test="error_preview_date_message"
                    >
                        {{ form.errors.preview_date }}
                    </div>
                </base-form-input-error>
            </div>
        </div>

        <slot></slot>
    </div>
</template>
