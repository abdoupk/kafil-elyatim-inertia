<script setup lang="ts">
import type { CreateFamilyForm } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'

defineProps<{ form: Form<CreateFamilyForm>; index: number }>()

const firstName = defineModel('first_name', { default: '' })

const lastName = defineModel('last_name')

const academicLevel = defineModel('academic_level')

const healthStatus = defineModel('health_status')

const birthDate = defineModel('birth_date', { default: '' })
</script>

<template>
    <div class="grid grid-cols-12 gap-4 gap-y-5 pt-2 pb-2.5 px-2 border-dashed border-2">
        <div class="intro-y col-span-12 sm:col-span-6">
            <base-form-label for="first_name">
                {{ $t('validation.attributes.first_name') }}
            </base-form-label>

            <base-form-input
                data-test="orphan_first_name"
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
                        `orphans.${index}.first_name`
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
                            `orphans.${index}.first_name`
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.first_name`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <slot></slot>
    </div>
</template>
