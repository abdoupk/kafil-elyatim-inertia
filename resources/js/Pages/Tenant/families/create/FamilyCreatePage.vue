<script setup lang="ts">
import type {
    CreateFamilyForm,
    CreateFamilyStepOneProps,
    CreateFamilyStepTwoProps,
    InspectorsMembersType,
    Zone
} from '@/types/types'

import { useForm } from 'laravel-precognition-vue'
import { type Ref, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import StepOne from '@/Pages/Tenant/families/create/StepOne/StepOne.vue'
import OrphanForm from '@/Pages/Tenant/families/create/StepThree/OrphanForm.vue'
import StepThree from '@/Pages/Tenant/families/create/StepThree/StepThree.vue'
import TheOrphans from '@/Pages/Tenant/families/create/StepThree/TheOrphans.vue'
import StepTitle from '@/Pages/Tenant/families/create/StepTitle.vue'
import IncomeForm from '@/Pages/Tenant/families/create/StepTwo/IncomeForm.vue'
import SecondSponsorForm from '@/Pages/Tenant/families/create/StepTwo/SecondSponsorForm.vue'
import SponsorForm from '@/Pages/Tenant/families/create/StepTwo/SponsorForm.vue'
import SpouseForm from '@/Pages/Tenant/families/create/StepTwo/SpouseForm.vue'
import StepTwo from '@/Pages/Tenant/families/create/StepTwo/StepTwo.vue'
import TheActions from '@/Pages/Tenant/families/create/TheActions.vue'
import FurnishingForm from '@/Pages/Tenant/families/create/stepFour/FurnishingForm.vue'
import HousingForm from '@/Pages/Tenant/families/create/stepFour/HousingForm.vue'
import OtherPropertiesForm from '@/Pages/Tenant/families/create/stepFour/OtherPropertiesForm.vue'
import StepFour from '@/Pages/Tenant/families/create/stepFour/StepFour.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import {
    createFamilyFormAttributes,
    createFamilyStepFiveErrorProps,
    createFamilyStepFourErrorProps,
    createFamilyStepOneErrorProps,
    createFamilyStepSixErrorProps,
    createFamilyStepsTitles,
    createFamilyStepThreeErrorProps,
    createFamilyStepTwoErrorProps
} from '@/utils/constants'
import StepFive from '@/Pages/Tenant/families/create/stepFive/StepFive.vue'
import StepSix from '@/Pages/Tenant/families/create/StepSix/StepSix.vue'
import FamilySponsorShipForm from '@/Pages/Tenant/families/create/StepSix/FamilySponsorShipForm.vue'
import SponsorSponsorShipForm from '@/Pages/Tenant/families/create/StepSix/SponsorSponsorShipForm.vue'
import OrphansSponsorShipForm from '@/Pages/Tenant/families/create/StepSix/OrphansSponsorShipForm.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{ zones: Zone[], members: InspectorsMembersType }>()

const currentStep = ref(5)

const totalSteps = 6

const form = useForm('post', route('tenant.families.store'), createFamilyFormAttributes)

const stepOneCompleted = ref<boolean>(true) //TODO change To False

const stepTwoCompleted = ref<boolean>(true) //TODO change To False

const stepThreeCompleted = ref<boolean>(true) //TODO change To False

const stepFourCompleted = ref<boolean>(true) //TODO change To False

const stepFiveCompleted = ref<boolean>(true) //TODO change To False

const addOrphan = () => {
    form.orphans.push({
        academic_level: '',
        birth_date: '',
        family_status: '',
        health_status: '',
        last_name: '',
        note: '',
        pants_size: '',
        shirt_size: '',
        shoes_size: '',
        first_name: ''
    })
}

const removeOrphan = (index: number) => {
    if (index > 0) {
        form.orphans.splice(index, 1)
    }
}

const validating = ref<boolean>(false)

const validateStep = async (errorProps: CreateFamilyStepOneProps[] | CreateFamilyStepTwoProps[], step: Ref) => {
    validating.value = true

    await form.submit({
        onFinish() {
            let errors = []

            errorProps.forEach((prop) => {
                const regex = prop === 'address' ? new RegExp(`^${prop}$`) : new RegExp(prop)

                Object.keys(form.errors).forEach((error) => {
                    if (regex.test(error)) {

                        errors.push(form.errors[error as keyof CreateFamilyForm])
                    }
                })
            })

            step.value = errors.length === 0 && !form.validating

            validating.value = false
        }
    }).catch(() => {
        console.error()
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

const forgetErrors = (errors: string[]) => {
    errors.forEach((prop: CreateFamilyStepTwoProps) => {
        const regex = prop === 'address' ? new RegExp(`^${prop}$`) : new RegExp(prop)

        Object.keys(form.errors).forEach((error) => {
            if (regex.test(error)) {
                form.forgetError(error as keyof CreateFamilyForm)
            }
        })

    })
}

const goTo = async (index: number) => {
    if (index <= currentStep.value) {
        currentStep.value = index
    } else {
        if (index === 2) {
            await validateStep(createFamilyStepOneErrorProps, stepOneCompleted).finally(() => {
                forgetErrors(createFamilyStepTwoErrorProps)

                if (stepOneCompleted.value) currentStep.value = 2
            })
        }

        if (index === 3) {
            await validateStep(createFamilyStepTwoErrorProps, stepTwoCompleted).finally(() => {
                if (stepOneCompleted.value && stepTwoCompleted.value) {
                    forgetErrors(createFamilyStepThreeErrorProps)

                    currentStep.value = 3
                }
            })
        }

        if (index === 4) {
            await validateStep(createFamilyStepThreeErrorProps, stepThreeCompleted).finally(() => {
                if (stepOneCompleted.value && stepTwoCompleted.value && stepThreeCompleted.value) {
                    forgetErrors(createFamilyStepFourErrorProps)

                    currentStep.value = 4
                }
            })
        }

        if (index === 5) {
            await validateStep(createFamilyStepFourErrorProps, stepFourCompleted).finally(() => {
                if (stepOneCompleted.value && stepTwoCompleted.value && stepThreeCompleted.value && stepFourCompleted.value) {
                    forgetErrors(createFamilyStepFiveErrorProps)

                    currentStep.value = 5
                }
            })
        }

        if (index === 6) {
            await validateStep(createFamilyStepFiveErrorProps, stepFiveCompleted).finally(() => {
                if (stepOneCompleted.value && stepTwoCompleted.value && stepThreeCompleted.value && stepFourCompleted.value && stepFiveCompleted.value) {
                    forgetErrors(createFamilyStepSixErrorProps)

                    currentStep.value = 6
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
                class="relative flex flex-col justify-center px-5 before:absolute before:bottom-0 before:top-0 before:mt-4 before:hidden before:h-[3px] before:w-[70%] before:bg-slate-100 before:dark:bg-darkmode-400 sm:px-20 lg:flex-row before:lg:block"
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

                <step-two :currentStep :totalSteps :form>
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
                            v-model:death-date="form.spouse.death_date"
                            v-model:birth-date="form.spouse.birth_date"
                            v-model:income="form.spouse.income"
                            v-model:job="form.spouse.function"
                            :form
                        ></spouse-form>
                    </template>
                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-two>

                <step-three :currentStep :totalSteps>
                    <template #orphansForm>
                        <template v-for="(orphan, index) in form.orphans" :key="`orphan-${index}`">
                            <the-orphans :index @remove-orphan="removeOrphan">
                                <orphan-form
                                    v-model:first_name="orphan.first_name"
                                    v-model:last_name="orphan.last_name"
                                    v-model:academic_level="orphan.academic_level"
                                    v-model:health_status="orphan.health_status"
                                    v-model:family_status="orphan.family_status"
                                    v-model:birth_date="orphan.birth_date"
                                    v-model:shoes-size="orphan.shoes_size"
                                    v-model:pants-size="orphan.pants_size"
                                    v-model:shirt-size="orphan.shirt_size"
                                    v-model:note="orphan.note"
                                    :form
                                    :index
                                ></orphan-form>
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

                            {{ $t('add_new_orphan') }}
                        </base-button>
                    </template>

                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-three>

                <step-four :currentStep :totalSteps :form>
                    <template #housingForm>
                        <housing-form
                            :form
                            v-model:housing-receipt-number="form.housing.housing_receipt_number"
                            v-model:number-of-rooms="form.housing.number_of_rooms"
                            v-model:housing-type="form.housing.housing_type"
                        ></housing-form>
                    </template>

                    <template #furnishingForm>
                        <furnishing-form :form @update:furnishings="form.furnishings = {...$event}"></furnishing-form>
                    </template>

                    <template #otherPropertiesForm>
                        <other-properties-form :form
                                               v-model:other-properties="form.other_properties"></other-properties-form>
                    </template>

                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-four>

                <step-five :currentStep :totalSteps :members :form
                           v-model:inspectors-members="form.inspectors_members"
                           v-model:preview-date="form.preview_date"
                           v-model:report="form.report">
                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep></the-actions>
                </step-five>

                <step-six :currentStep :totalSteps :form>
                    <template #FamilySponsorShipForm>
                        <family-sponsor-ship-form></family-sponsor-ship-form>
                    </template>

                    <template #SponsorSponsorShipForm>
                        <sponsor-sponsor-ship-form></sponsor-sponsor-ship-form>
                    </template>

                    <template #OrphansSponsorShipForm>
                        <orphans-sponsor-ship-form></orphans-sponsor-ship-form>
                    </template>
                    <the-actions :validating :currentStep :prevStep :totalSteps :nextStep="submit"></the-actions>
                </step-six>
            </form>
        </div>
    </div>
</template>
