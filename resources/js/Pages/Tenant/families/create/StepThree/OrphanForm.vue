<script lang="ts" setup>
import type { CreateFamilyForm } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormTextArea from '@/Components/Base/form/BaseFormTextArea.vue'
import { watch } from 'vue'

const props = defineProps<{ form: Form<CreateFamilyForm>; index: number }>()

watch(props.form.orphans, (value) => {
    document.getElementById(`first_name_${value.length - 1}`)?.focus()
})

const firstName = defineModel('first_name', { default: '' })

const lastName = defineModel('last_name')

const academicLevel = defineModel('academic_level')

const healthStatus = defineModel('health_status')

const familyStatus = defineModel('family_status')

const shoesSize = defineModel('shoesSize')

const pantsSize = defineModel('pantsSize')

const shirtSize = defineModel('shirtSize')

const note = defineModel('note')

const birthDate = defineModel('birth_date', { default: '' })
</script>

<template>
    <div class="grid grid-cols-12 gap-4 gap-y-5 pt-2 pb-2.5 px-2 border-dashed border-2">
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="first_name">
                {{ $t('validation.attributes.first_name') }}
            </base-form-label>

            <base-form-input
                :id="`first_name_${index}`"
                v-model="firstName"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.first_name')
                    })
                "
                data-test="orphan_first_name"
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.first_name`
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.first_name`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_first_name_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.first_name`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="last_name">
                {{ $t('validation.attributes.last_name') }}
            </base-form-label>

            <base-form-input
                :id="`last_name_${index}`"
                v-model="lastName"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.last_name')
                    })
                "
                data-test="orphan_last_name"
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.last_name`
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.last_name`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_last_name_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.last_name`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="orphans.birth_date">
                {{ $t('validation.attributes.date_of_birth') }}
            </base-form-label>

            <base-v-calendar v-model:date="birthDate"></base-v-calendar>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.birth_date`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_start_date_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.birth_date`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="health_status">
                {{ $t('validation.attributes.sponsor.health_status') }}
            </base-form-label>

            <base-form-input
                :id="`health_status_${index}`"
                v-model="healthStatus"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.health_status')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.health_status`
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.health_status`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_health_status_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.health_status`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="family_status">
                {{ $t('family_status') }}
            </base-form-label>

            <base-form-input
                :id="`family_status_${index}`"
                v-model="familyStatus"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('family_status')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.family_status`
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.family_status`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_family_status_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.family_status`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="academic_level">
                {{ $t('validation.attributes.sponsor.academic_level') }}
            </base-form-label>

            <base-form-input
                :id="`academic_level_${index}`"
                v-model="academicLevel"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.academic_level')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.academic_level`
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.academic_level`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_academic_level_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.academic_level`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="shoes_size">
                {{ $t('shoes_size') }}
            </base-form-label>

            <base-form-input
                :id="`shoes_size_${index}`"
                v-model="shoesSize"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('shoes_size')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.shoes_size`
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.shoes_size`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_shoes_size_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.shoes_size`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="shirt_size">
                {{ $t('shirt_size') }}
            </base-form-label>

            <base-form-input
                :id="`shirt_size_${index}`"
                v-model="shirtSize"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('shirt_size')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.shirt_size`
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.shirt_size`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_shirt_size_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.shirt_size`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="pants_size">
                {{ $t('pants_size') }}
            </base-form-label>

            <base-form-input
                :id="`pants_size_${index}`"
                v-model="pantsSize"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('pants_size')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.pants_size`
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.pants_size`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_pants_size_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.pants_size`]
                    }}
                </div>
            </base-form-input-error>
        </div>

        <div class="col-span-8">
            <base-form-label for="note">
                {{ $t('notes') }}
            </base-form-label>

            <base-form-text-area
                :id="`note_${index}`"
                v-model="note"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('notes')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        `orphans.${index}.note`
                    )
                "
            ></base-form-text-area>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            `orphans.${index}.note`
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_note_message"
                >
                    {{
                        //@ts-ignore
                        form.errors[`orphans.${index}.note`]
                    }}
                </div>
            </base-form-input-error>
        </div>
        <slot></slot>
    </div>
</template>
