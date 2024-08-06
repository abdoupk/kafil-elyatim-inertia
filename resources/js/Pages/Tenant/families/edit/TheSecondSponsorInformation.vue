<script lang="ts" setup>
import type { FamilyUpdateSecondSponsorFormType, SecondSponsorType } from '@/types/families'

import { useForm } from 'laravel-precognition-vue'
import { reactive, ref } from 'vue'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'
import SuccessNotification from '@/Pages/Shared/SuccessNotification.vue'
import FurnishingForm from '@/Pages/Tenant/families/create/stepFour/FurnishingForm.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'

import { omit } from '@/utils/helper'

const props = defineProps<{ secondSponsor: SecondSponsorType }>()

const inputs = reactive<FamilyUpdateSecondSponsorFormType>(omit(props.secondSponsor, ['id', 'family_id']))

const form = useForm('put', route('tenant.families.spouse-update', props.secondSponsor.family_id), inputs)

const updateSuccess = ref(false)

const submit = () => {
    form.submit({
        onSuccess() {
            updateSuccess.value = true

            Object.keys(form.errors).forEach((error) => {
                form.forgetError(error as keyof FamilyUpdateSecondSponsorFormType)
            })
        },
        onFinish() {
            updateSuccess.value = false
        }
    })
}
</script>

<template>
    <!-- BEGIN: Second Sponsor Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ secondSponsor.name }}</h2>

            <div
                class="mt-2 flex w-fit items-center truncate rounded-full bg-success/30 px-2 py-1 text-sm font-semibold text-success dark:bg-darkmode-400"
            >
                {{ $t(secondSponsor.degree_of_kinship) }}
            </div>
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

                <!-- BEGIN: Degree of Kinship -->
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
                <!-- END: Degree of Kinship -->

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

                <!-- BEGIN: Address -->
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
                <!-- END: Address -->

                <!-- BEGIN: Phone Number -->
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
                <!-- END: Phone Number -->

                <base-button :disabled="form.processing" class="w-20 !mt-0" type="submit" variant="primary">
                    {{ $t('save') }}

                    <spinner-button-loader :show="form.processing" class="ms-auto"></spinner-button-loader>
                </base-button>
            </div>
        </form>
    </div>
    <!-- END: Second Sponsor Information -->
    <div class="w-full col-span-12">
        <furnishing-form class="w-full"></furnishing-form>
    </div>
    <success-notification :open="updateSuccess" :title="$t('successfully_updated')"></success-notification>
</template>
