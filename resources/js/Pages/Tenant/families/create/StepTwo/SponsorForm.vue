<script lang="ts" setup>
import type { AcademicLevelType } from '@/types/lessons'
import type { CreateFamilyForm } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'
import { ref } from 'vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'
import { __ } from '@/utils/i18n'

defineProps<{
    form?: Form<CreateFamilyForm>
    academicLevels: AcademicLevelType[]
}>()

const vueSelectAcademicLevel = ref({})

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

// Const cardNumber = defineModel('card_number')

const ccp = defineModel('ccp')

const sponsorType = defineModel('sponsorType')

const birthDate = defineModel('birth_date', { default: '' })

const sponsorTypes = [
    {
        label: __('father'),
        value: 'father'
    },
    {
        label: __('mother'),
        value: 'mother'
    },
    {
        label: __('grand_father'),
        value: 'grand_father'
    },
    {
        label: __('grand_mother'),
        value: 'grand_mother'
    },
    {
        label: __('other'),
        value: 'other'
    }
]
</script>

<template>
    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-6">
        <!-- Begin: Card Number-->
        <!--        <div class="col-span-12 sm:col-span-6">-->
        <!--            <base-form-label for="card_number">-->
        <!--                {{ $t('validation.attributes.sponsor.card_number') }}-->
        <!--            </base-form-label>-->

        <!--            <base-form-input-->
        <!--                id="card_number"-->
        <!--                v-model="cardNumber"-->
        <!--                :placeholder="-->
        <!--                    $t('auth.placeholders.fill', {-->
        <!--                        attribute: $t('validation.attributes.sponsor.card_number')-->
        <!--                    })-->
        <!--                "-->
        <!--                type="text"-->
        <!--                @change="-->
        <!--                    form?.validate(-->
        <!--                        //@ts-ignore-->
        <!--                        'sponsor.card_number'-->
        <!--                    )-->
        <!--                "-->
        <!--                @keydown="allowOnlyNumbersOnKeyDown"-->
        <!--            ></base-form-input>-->

        <!--            <base-form-input-error>-->
        <!--                <div-->
        <!--                    v-if="-->
        <!--                        form?.invalid(-->
        <!--                            //@ts-ignore-->
        <!--                            'sponsor.card_number'-->
        <!--                        )-->
        <!--                    "-->
        <!--                    class="mt-2 text-danger"-->
        <!--                    data-test="error_card_number_message"-->
        <!--                >-->
        <!--                    {{-->
        <!--                        //@ts-ignore-->
        <!--                        form.errors['sponsor.card_number']-->
        <!--                    }}-->
        <!--                </div>-->
        <!--            </base-form-input-error>-->
        <!--        </div>-->
        <!-- End: Card Number-->

        <!-- Begin: First Name -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="first_name">
                {{ $t('validation.attributes.first_name') }}
            </base-form-label>

            <base-form-input
                id="first_name"
                v-model="firstName"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.first_name')
                    })
                "
                autofocus
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.first_name'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.first_name'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_first_name_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.first_name']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- END: First Name -->

        <!-- Begin: Last Name -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="last_name">
                {{ $t('validation.attributes.last_name') }}
            </base-form-label>

            <base-form-input
                id="last_name"
                v-model="lastName"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.last_name')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.last_name'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.last_name'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_last_name_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.last_name']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Last Name -->

        <!-- Begin: CCP -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="ccp">
                {{ $t('ccp') }}
            </base-form-label>

            <base-form-input
                id="ccp"
                v-model="ccp"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('ccp')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.ccp'
                    )
                "
                @keydown="allowOnlyNumbersOnKeyDown"
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.ccp'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_ccp_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.ccp']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: CCP -->

        <!-- Begin: Branch -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="branch">
                {{ $t('the_sponsor') }}
            </base-form-label>

            <div>
                <base-vue-select
                    :options="sponsorTypes"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_sponsor') })"
                    label="label"
                    track_by="value"
                    @update:value="
                        (type) => {
                            sponsorType = type.value
                            // @ts-ignore
                            form?.validate('sponsor.sponsor_type')
                        }
                    "
                ></base-vue-select>
            </div>

            <base-form-input-error>
                <div v-if="form?.invalid('branch_id')" class="mt-2 text-danger" data-test="error_branch_message">
                    {{ form.errors.branch_id }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Branch -->

        <!-- Begin: Birth Date -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="sponsor.birth_date">
                {{ $t('validation.attributes.sponsor.birth_date') }}
            </base-form-label>

            <base-v-calendar v-model:date="birthDate"></base-v-calendar>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.birth_date'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_start_date_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.birth_date']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Birth Date -->

        <!-- Begin: Phone Number -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="phone_number">
                {{ $t('validation.attributes.phone') }}
            </base-form-label>

            <base-form-input
                id="phone_number"
                v-model="phone"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.phone')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.phone_number'
                    )
                "
                @keydown="allowOnlyNumbersOnKeyDown"
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.phone_number'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_phone_number_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.phone_number']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Phone Number -->

        <!-- Begin: Father Name -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="father_name">
                {{ $t('validation.attributes.sponsor.father_name') }}
            </base-form-label>

            <base-form-input
                id="father_name"
                v-model="fatherName"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.father_name')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.father_name'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.father_name'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_father_name_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.father_name']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Father Name -->

        <!-- Begin: Mother Name -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="mother_name">
                {{ $t('validation.attributes.sponsor.mother_name') }}
            </base-form-label>

            <base-form-input
                id="mother_name"
                v-model="motherName"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.mother_name')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.mother_name'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.mother_name'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_mother_name_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.mother_name']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Mother Name -->

        <!-- Begin: Birth Certificate Number -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="birth_certificate_number">
                {{ $t('validation.attributes.sponsor.birth_certificate_number') }}
            </base-form-label>

            <base-form-input
                id="birth_certificate_number"
                v-model="birthCertificateNumber"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.birth_certificate_number')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.birth_certificate_number'
                    )
                "
                @keydown="allowOnlyNumbersOnKeyDown"
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.birth_certificate_number'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_birth_certificate_number_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.birth_certificate_number']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Birth Certificate Number -->

        <!-- Begin: Academic Level -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="academic_level">
                {{ $t('validation.attributes.sponsor.academic_level') }}
            </base-form-label>

            <div>
                <base-vue-select
                    id="academic_level"
                    v-model:value="vueSelectAcademicLevel"
                    :allow-empty="false"
                    :options="academicLevels"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_child') })"
                    class="h-full w-full"
                    group-label="phase"
                    group-values="levels"
                    label="name"
                    track-by="id"
                    @update:value="
                        (value) => {
                            academicLevel = value.id

                            // @ts-ignore
                            form?.validate(`sponsor.academic_level_id`)
                        }
                    "
                >
                </base-vue-select>
            </div>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.academic_level_id'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_academic_level_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.academic_level_id']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Academic Level -->

        <!-- Begin: Function -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="function">
                {{ $t('validation.attributes.sponsor.function') }}
            </base-form-label>

            <base-form-input
                id="function"
                v-model="job"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.function')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.function'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.function'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_function_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.function']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Function -->

        <!-- Begin: Health Status -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="health_status">
                {{ $t('validation.attributes.sponsor.health_status') }}
            </base-form-label>

            <base-form-input
                id="health_status"
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
                        'sponsor.health_status'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.health_status'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_health_status_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.health_status']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Health Status -->

        <!-- Begin: Diploma -->
        <div class="col-span-12 sm:col-span-6">
            <base-form-label for="diploma">
                {{ $t('validation.attributes.sponsor.diploma') }}
            </base-form-label>

            <base-form-input
                id="diploma"
                v-model="diploma"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('validation.attributes.sponsor.diploma')
                    })
                "
                type="text"
                @change="
                    form?.validate(
                        //@ts-ignore
                        'sponsor.diploma'
                    )
                "
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'sponsor.diploma'
                        )
                    "
                    class="mt-2 text-danger"
                    data-test="error_diploma_message"
                >
                    {{
                        //@ts-ignore
                        form.errors['sponsor.diploma']
                    }}
                </div>
            </base-form-input-error>
        </div>
        <!-- End: Diploma -->

        <slot></slot>
    </div>
</template>
