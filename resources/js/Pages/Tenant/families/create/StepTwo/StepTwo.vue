<script setup lang="ts">
import type { CreateFamilyStepProps } from '@/types/types'
import BaseTabGroup from '@/Components/Base/headless/Tab/BaseTabGroup.vue'
import BaseTab from '@/Components/Base/headless/Tab/BaseTab.vue'
import BaseTabButton from '@/Components/Base/headless/Tab/BaseTabButton.vue'
import BaseTabList from '@/Components/Base/headless/Tab/BaseTabList.vue'
import BaseTabPanels from '@/Components/Base/headless/Tab/BaseTabPanels.vue'
import BaseTabPanel from '@/Components/Base/headless/Tab/BaseTabPanel.vue'
import SponsorForm from '@/Pages/Tenant/families/create/StepTwo/SponsorForm.vue'

defineProps<CreateFamilyStepProps>()

const firstName = defineModel('sponsor.first_name')

const lastName = defineModel('sponsor.last_name')

const phone = defineModel('sponsor.phone')

const fatherName = defineModel('sponsor.father_name')

const motherName = defineModel('sponsor.mother_name')

const birthCertificateNumber = defineModel('sponsor.birth_certificate_number')

const academicLevel = defineModel('sponsor.academic_level')

const job = defineModel('sponsor.function')

const healthStatus = defineModel('sponsor.health_status')

const diploma = defineModel('sponsor.diploma')

const cardNumber = defineModel('sponsor.card_number')

const birthDate = defineModel('sponsor.birth_date', { default: '' })
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
        v-if="currentStep === 2"
    >
        <div class="text-base font-medium">
            {{ $t('auth.register.stepTwo.title') }}
        </div>
        <base-tab-group class="mt-5">
            <base-tab-list variant="boxed-tabs">
                <base-tab>
                    <base-tab-button class="w-full py-2" as="button">
                        {{ $t('sponsor information') }}
                    </base-tab-button>
                </base-tab>
                <base-tab>
                    <base-tab-button class="w-full py-2" as="button">
                        {{ $t('income information') }}
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button">
                        {{ $t('second sponsor information') }}
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button">
                        {{ $t('spouse information') }}
                    </base-tab-button>
                </base-tab>
            </base-tab-list>
            <base-tab-panels>
                <base-tab-panel class="p-5">
                    <sponsor-form :form></sponsor-form>
                </base-tab-panel>
                <base-tab-panel class="p-5 leading-relaxed">
                    It is a long established fact that a reader will be
                    distracted by the readable content of a page when looking at
                    its layout. The point of using Lorem Ipsum is that it has a
                    more-or-less normal distribution of letters, as opposed to
                    using 'Content here, content here', making it look like
                    readable English. Many desktop publishing packages and web
                    page editors now use Lorem Ipsum as their default model
                    text, and a search for 'lorem ipsum' will uncover many web
                    sites still in their infancy. Various versions have evolved
                    over the years, sometimes by accident, sometimes on purpose
                    (injected humour and the like).
                </base-tab-panel>
            </base-tab-panels>
        </base-tab-group>

        <slot></slot>
    </div>

</template>
