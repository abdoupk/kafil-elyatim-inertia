<script lang="ts" setup>
import type { FamilyUpdateSpouseFormType, SpouseType } from '@/types/families'

import { useForm } from 'laravel-precognition-vue'
import { reactive, ref } from 'vue'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'
import SuccessNotification from '@/Pages/Shared/SuccessNotification.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'

import { omit } from '@/utils/helper'

const props = defineProps<{ spouse: SpouseType }>()

// eslint-disable-next-line array-element-newline
const inputs = reactive<FamilyUpdateSpouseFormType>(omit(props.spouse, ['id', 'family_id', 'name']))

const form = useForm('put', route('tenant.families.spouse-update', props.spouse.family_id), inputs)

const updateSuccess = ref(false)

const submit = () => {
    form.submit({
        onSuccess() {
            updateSuccess.value = true

            Object.keys(form.errors).forEach((error) => {
                form.forgetError(error as keyof FamilyUpdateSpouseFormType)
            })
        },
        onFinish() {
            updateSuccess.value = false
        }
    })
}
</script>

<template>
    <!-- BEGIN: Spouse Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ spouse.name }}</h2>
        </div>

        <form @submit.prevent="submit">
            <div class="p-5 grid grid-cols-12 gap-4">
                <!-- BEGIN: First Name -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="first_name">
                        {{ $t('validation.attributes.first_name') }}
                    </base-form-label>

                    <base-form-input
                        id="first_name"
                        v-model="form.first_name"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.first_name')
                            })
                        "
                        data-test="spouse_first_name"
                        type="text"
                        @change="form?.validate('first_name')"
                    ></base-form-input>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('first_name')"
                            class="mt-2 text-danger"
                            data-test="error_first_name_message"
                        >
                            {{ form.errors.first_name }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: First Name -->

                <!-- BEGIN: Last Name -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="last_name">
                        {{ $t('validation.attributes.last_name') }}
                    </base-form-label>

                    <base-form-input
                        id="last_name"
                        v-model="form.last_name"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.last_name')
                            })
                        "
                        data-test="spouse_last_name"
                        type="text"
                        @change="form?.validate('last_name')"
                    ></base-form-input>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('last_name')"
                            class="mt-2 text-danger"
                            data-test="error_last_name_message"
                        >
                            {{ form.errors.last_name }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Last Name -->

                <!-- BEGIN: Birth Date -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="birth_date">
                        {{ $t('validation.attributes.spouse.birth_date') }}
                    </base-form-label>

                    <base-v-calendar id="birth_date" v-model:date="form.birth_date"></base-v-calendar>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('birth_date')"
                            class="mt-2 text-danger"
                            data-test="error_birth_date_message"
                        >
                            {{ form.errors.birth_date }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Birth Date -->

                <!-- BEGIN: Death Date -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="death_date">
                        {{ $t('validation.attributes.spouse.death_date') }}
                    </base-form-label>

                    <base-v-calendar id="death_date" v-model:date="form.death_date"></base-v-calendar>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('death_date')"
                            class="mt-2 text-danger"
                            data-test="error_death_date_message"
                        >
                            {{ form.errors.death_date }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Death Date -->

                <!-- BEGIN: Function (Job) -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="function">
                        {{ $t('filters.spouse.function') }}
                    </base-form-label>

                    <base-form-input
                        id="function"
                        v-model="form.function"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('filters.spouse.function')
                            })
                        "
                        data-test="spouse_function"
                        type="text"
                        @change="form?.validate('function')"
                    ></base-form-input>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('function')"
                            class="mt-2 text-danger"
                            data-test="error_function_message"
                        >
                            {{ form.errors.function }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Function (Job) -->

                <!-- BEGIN: Income -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="income">
                        {{ $t('validation.attributes.income') }}
                    </base-form-label>

                    <base-form-input
                        id="income"
                        v-model="form.income"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.income')
                            })
                        "
                        data-test="spouse_income"
                        step="0.01"
                        type="number"
                        @change="form?.validate('income')"
                    ></base-form-input>

                    <base-form-input-error>
                        <div v-if="form?.invalid('income')" class="mt-2 text-danger" data-test="error_income_message">
                            {{ form.errors.income }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Income -->

                <base-button :disabled="form.processing" class="w-20 !mt-0" type="submit" variant="primary">
                    {{ $t('save') }}

                    <spinner-button-loader :show="form.processing" class="ms-auto"></spinner-button-loader>
                </base-button>
            </div>
        </form>
    </div>
    <!-- END: Spouse Information -->

    <success-notification :open="updateSuccess" :title="$t('successfully_updated')"></success-notification>
</template>
