<script lang="ts" setup>
import type { RegisterStepOneProps, RegisterStepTwoProps } from '@/types/types'

import { Head } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'
import { type Ref, ref } from 'vue'

import StepOne from '@/Pages/Auth/Register/StepOne.vue'
import StepThree from '@/Pages/Auth/Register/StepThree.vue'
import StepTitle from '@/Pages/Auth/Register/StepTitle.vue'
import StepTwo from '@/Pages/Auth/Register/StepTwo.vue'
import TheActions from '@/Pages/Auth/Register/TheActions.vue'

import SuccessNotification from '@/Components/Global/SuccessNotification.vue'

import {
    registerFormAttributes,
    registerStepOneErrorProps,
    registerStepThreeErrorProps,
    registerStepTwoErrorProps,
    registerStepsTitles
} from '@/utils/constants'

const currentStep = ref(1)

const registeringCompleted = ref(false)

const totalSteps = 3

const form = useForm('post', route('register'), registerFormAttributes)

const stepOneCompleted = ref<boolean>(false)

const stepTwoCompleted = ref<boolean>(false)

const validating = ref<boolean>(false)

const validateStep = async (errorProps: RegisterStepOneProps[] | RegisterStepTwoProps[], step: Ref) => {
    validating.value = true

    await form.submit({
        onFinish() {
            const hasErrors = errorProps.every((prop) => !form.errors[prop])

            const touchedInputs = errorProps.every((prop) => form.touched(prop))

            step.value = hasErrors && touchedInputs && !form.validating

            validating.value = false
        }
    })
}

const nextStep = async () => {
    if (currentStep.value < totalSteps) {
        await goTo(currentStep.value + 1)
    }
}

const prevStep = () => {
    if (currentStep.value > 1) {
        currentStep.value--
    }
}

const goTo = async (index: number) => {
    if (index <= currentStep.value) {
        currentStep.value = index
    } else {
        if (index === 2) {
            await validateStep(registerStepOneErrorProps, stepOneCompleted).finally(() => {
                registerStepTwoErrorProps.forEach((prop) => form.forgetError(prop))

                if (stepOneCompleted.value) currentStep.value = 2
            })
        } else if (index === 3) {
            await validateStep(registerStepTwoErrorProps, stepTwoCompleted).finally(() => {
                if (stepOneCompleted.value && stepTwoCompleted.value) {
                    registerStepThreeErrorProps.forEach((prop) => form.forgetError(prop))

                    currentStep.value = 3
                }
            })
        }
    }
}

const submit = () => {
    validating.value = true

    form.submit({
        onSuccess(response) {
            registeringCompleted.value = true

            setTimeout(() => {
                window.location.href = response.data.url
            }, 4000)
        },
        onFinish() {
            validating.value = false
        }
    })
}
</script>

<template>
    <Head :title="$t('the_register')" />

    <div class="mx-auto h-screen max-w-3/4 flex-col content-center py-5">
        <div class="intro-y box py-10">
            <div
                class="relative flex flex-col justify-center px-5 before:absolute before:bottom-0 before:top-0 before:mt-4 before:hidden before:h-[3px] before:w-[59%] before:bg-slate-100 before:dark:bg-darkmode-400 sm:px-20 lg:flex-row before:lg:block"
            >
                <step-title
                    v-for="(title, index) in registerStepsTitles"
                    :key="`step-${index}`"
                    :current-step="currentStep"
                    :index="index + 1"
                    :title="title"
                    @go-to="goTo"
                ></step-title>
            </div>

            <form @submit.prevent="submit">
                <step-one
                    v-model:address="form.address"
                    v-model:association="form.association"
                    v-model:city="form.city"
                    v-model:domain="form.domain"
                    :currentStep
                    :form
                    :totalSteps
                >
                    <the-actions :currentStep :nextStep :prevStep :totalSteps :validating></the-actions>
                </step-one>

                <step-two
                    v-model:email="form.email"
                    v-model:first_name="form.first_name"
                    v-model:last_name="form.last_name"
                    v-model:password="form.password"
                    v-model:password_confirmation="form.password_confirmation"
                    v-model:phone="form.phone"
                    :currentStep
                    :form
                    :totalSteps
                >
                    <the-actions :currentStep :nextStep :prevStep :totalSteps :validating></the-actions>
                </step-two>

                <step-three
                    v-model:association_email="form.association_email"
                    v-model:ccp="form.ccp"
                    v-model:cpa="form.cpa"
                    v-model:landline="form.landline"
                    v-model:links="form.links"
                    v-model:phones="form.phones"
                    :currentStep
                    :form
                    :totalSteps
                >
                    <the-actions :currentStep :next-step="submit" :prevStep :totalSteps :validating></the-actions>
                </step-three>
            </form>
        </div>
    </div>

    <success-notification
        :open="registeringCompleted"
        :title="$t('auth.register.success.title')"
    ></success-notification>
</template>
