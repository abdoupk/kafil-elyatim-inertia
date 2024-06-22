<script setup lang="ts">
import type { CreateFamilyStepOneProps, CreateFamilyStepTwoProps, Zone } from '@/types/types'

import { useForm } from 'laravel-precognition-vue'
import { type Ref, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import StepOne from '@/Pages/Tenant/families/create/StepOne/StepOne.vue'
import StepTitle from '@/Pages/Tenant/families/create/StepTitle.vue'
import SponsorForm from '@/Pages/Tenant/families/create/StepTwo/SponsorForm.vue'
import StepTwo from '@/Pages/Tenant/families/create/StepTwo/StepTwo.vue'
import TheActions from '@/Pages/Tenant/families/create/TheActions.vue'

import {
    createFamilyFormAttributes,
    createFamilyStepOneErrorProps,
    createFamilyStepTwoErrorProps,
    createFamilyStepsTitles,
    registerStepThreeErrorProps,
    registerStepTwoErrorProps
} from '@/utils/constants'

defineOptions({
    layout: TheLayout
})

defineProps<{ zones: Zone[] }>()

const currentStep = ref(2)

const totalSteps = 3

const form = useForm('post', route('tenant.families.store'), createFamilyFormAttributes)

const stepOneCompleted = ref<boolean>(false)

const stepTwoCompleted = ref<boolean>(false)

const validating = ref<boolean>(false)

const validateStep = async (errorProps: CreateFamilyStepOneProps[], step: Ref) => {
    validating.value = true

    await form.submit({
        onFinish() {
            const hasErrors = errorProps.every((prop) => !form.errors[prop])

            const touchedInputs = errorProps.some((prop) => form.touched(prop))

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
            await validateStep(createFamilyStepOneErrorProps, stepOneCompleted).finally(() => {
                createFamilyStepTwoErrorProps.forEach((prop: CreateFamilyStepTwoProps) => form.forgetError(prop))

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
    <div class="mx-auto flex-col content-center py-5">
        <div class="intro-y box py-10">
            <div
                class="relative flex flex-col justify-center px-5 before:absolute before:bottom-0 before:top-0 before:mt-4 before:hidden before:h-[3px] before:w-[59%] before:bg-slate-100 before:dark:bg-darkmode-400 sm:px-20 lg:flex-row before:lg:block"
            >
                <step-title
                    @go-to="goTo"
                    v-for="(title, index) in createFamilyStepsTitles"
                    :key="`step-${index}`"
                    :current-step="currentStep"
                    :index="index + 1"
                    :title="title"
                ></step-title>
            </div>

            <form @submit.prevent="submit">
                <step-one
                    v-model:address="form.address"
                    v-model:zone="form.zone"
                    v-model:file-number="form.file_number"
                    v-model:start-date="form.start_date"
                    :form
                    :zones
                    :currentStep
                    :totalSteps
                >
                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-one>

                <step-two :currentStep :totalSteps>
                    <template #sponsorForm>
                        <sponsor-form
                            :form
                            v-model:first_name="form.sponsor.first_name"
                            v-model:last_name="form.sponsor.last_name"
                            v-model:phone="form.sponsor.phone_number"
                            v-model:father_name="form.sponsor.father_name"
                            v-model:mother_name="form.sponsor.mother_name"
                            v-model:birth_certificate_number="form.sponsor.birth_certificate_number"
                            v-model:academic_level="form.sponsor.academic_level"
                            v-model:function="form.sponsor.function"
                            v-model:health_status="form.sponsor.health_status"
                            v-model:diploma="form.sponsor.diploma"
                            v-model:card_number="form.sponsor.card_number"
                            v-model:birth_date="form.sponsor.birth_date"
                        ></sponsor-form>
                    </template>

                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-two>
            </form>
        </div>
    </div>
</template>
