<script setup lang="ts">
import type { CreateFamilyStepOneProps, CreateFamilyStepTwoProps, Zone } from '@/types/types'

import { useForm } from 'laravel-precognition-vue'
import { type Ref, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import StepOne from '@/Pages/Tenant/families/create/StepOne/StepOne.vue'
import StepThree from '@/Pages/Tenant/families/create/StepThree/StepThree.vue'
import StepTitle from '@/Pages/Tenant/families/create/StepTitle.vue'
import IncomeForm from '@/Pages/Tenant/families/create/StepTwo/IncomeForm.vue'
import SecondSponsorForm from '@/Pages/Tenant/families/create/StepTwo/SecondSponsorForm.vue'
import SponsorForm from '@/Pages/Tenant/families/create/StepTwo/SponsorForm.vue'
import SpouseForm from '@/Pages/Tenant/families/create/StepTwo/SpouseForm.vue'
import StepTwo from '@/Pages/Tenant/families/create/StepTwo/StepTwo.vue'
import TheActions from '@/Pages/Tenant/families/create/TheActions.vue'
import FurnishingForm from '@/Pages/Tenant/families/create/stepFive/FurnishingForm.vue'
import HousingForm from '@/Pages/Tenant/families/create/stepFive/HousingForm.vue'
import OtherPropertiesForm from '@/Pages/Tenant/families/create/stepFive/OtherPropertiesForm.vue'
import StepFive from '@/Pages/Tenant/families/create/stepFive/StepFive.vue'
import OrphanForm from '@/Pages/Tenant/families/create/stepFour/OrphanForm.vue'
import StepFour from '@/Pages/Tenant/families/create/stepFour/StepFour.vue'
import TheOrphans from '@/Pages/Tenant/families/create/stepFour/TheOrphans.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

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

const currentStep = ref(4)

const totalSteps = 5

const form = useForm('post', route('tenant.families.store'), createFamilyFormAttributes)

const stepOneCompleted = ref<boolean>(false)

const stepTwoCompleted = ref<boolean>(false)

const addOrphan = () => {
    form.orphans.push({ first_name: '' })
}

const removeOrphan = (index: number) => {
    if (form.orphans.length > 1) {
        form.orphans.splice(index, 1)
    }
}

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

        if (index === 5) {
            await form.submit()
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

                    <template #incomeForm>
                        <income-form
                            v-model:cnr="form.incomes.cnr"
                            v-model:cnas="form.incomes.cnas"
                            v-model:casnos="form.incomes.casnos"
                            v-model:pension="form.incomes.pension"
                            v-model:other_income="form.incomes.other_income"
                            v-model:account="form.incomes.account"
                            :form
                        ></income-form>
                    </template>

                    <template #secondSponsorForm>
                        <second-sponsor-form
                            v-model:first_name="form.second_sponsor.first_name"
                            v-model:last_name="form.second_sponsor.last_name"
                            v-model:degree_of_kinship="form.second_sponsor.degree_of_kinship"
                            v-model:address="form.second_sponsor.address"
                            v-model:income="form.second_sponsor.income"
                            v-model:phone="form.second_sponsor.phone_number"
                            :form
                        ></second-sponsor-form>
                    </template>

                    <template #spouseForm>
                        <spouse-form
                            v-model:first_name="form.spouse.first_name"
                            v-model:last_name="form.spouse.last_name"
                            v-model:death_date="form.spouse.death_date"
                            v-model:birth_date="form.spouse.birth_date"
                            v-model:income="form.spouse.income"
                            v-model:job="form.spouse.function"
                            :form
                        ></spouse-form>
                    </template>
                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-two>

                <step-three :currentStep :totalSteps></step-three>

                <step-four :currentStep :totalSteps>
                    <template #orphansForm>
                        <template v-for="(orphan, index) in form.orphans" :key="`orphan-${index}`">
                            <the-orphans :index @remove-orphan="removeOrphan">
                                <orphan-form :form :index v-model:first_name="orphan.first_name"></orphan-form>
                            </the-orphans>
                        </template>

                        <base-button
                            type="button"
                            variant="outline-primary"
                            class="mx-auto mt-4 block w-1/2 border-dashed dark:text-slate-500"
                            data-test="add_orphan"
                            @click="addOrphan"
                        >
                            <svg-loader name="icon-plus" class="inline fill-primary dark:fill-slate-500"></svg-loader>

                            {{ $t('auth.register.stepThree.add_new_phone') }}
                        </base-button>
                    </template>

                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-four>

                <step-five :currentStep :totalSteps>
                    <template #housingForm>
                        <housing-form :form></housing-form>
                    </template>

                    <template #furnishingForm>
                        <furnishing-form :form></furnishing-form>
                    </template>

                    <template #otherPropertiesForm>
                        <other-properties-form :form></other-properties-form>
                    </template>

                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-five>
            </form>
        </div>
    </div>
</template>
