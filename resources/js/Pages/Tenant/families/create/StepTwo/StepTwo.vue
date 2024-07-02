<script setup lang="ts">
import type { CreateFamilyStepProps } from '@/types/types'

import { computed } from 'vue'

import BaseTab from '@/Components/Base/headless/Tab/BaseTab.vue'
import BaseTabButton from '@/Components/Base/headless/Tab/BaseTabButton.vue'
import BaseTabGroup from '@/Components/Base/headless/Tab/BaseTabGroup.vue'
import BaseTabList from '@/Components/Base/headless/Tab/BaseTabList.vue'
import BaseTabPanel from '@/Components/Base/headless/Tab/BaseTabPanel.vue'
import BaseTabPanels from '@/Components/Base/headless/Tab/BaseTabPanels.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { checkErrors } from '@/utils/helper'

const props = defineProps<CreateFamilyStepProps>()

const sponsorErrors = computed(() => {
    return checkErrors('^sponsor.', props?.form?.errors)
})

const secondSponsorErrors = computed(() => {
    return checkErrors('^second_sponsor', props?.form?.errors)
})

const incomeErrors = computed(() => {
    return checkErrors('^income', props?.form?.errors)
})

const spouseErrors = computed(() => {
    return checkErrors('^spouse', props?.form?.errors)
})
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
            <base-tab-list variant="link-tabs">
                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('sponsor information') }}

                        <svg-loader
                            v-if="sponsorErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>
                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('income information') }}

                        <svg-loader
                            v-if="incomeErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('second sponsor information') }}

                        <svg-loader
                            v-if="secondSponsorErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('spouse information') }}

                        <svg-loader
                            v-if="spouseErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>
            </base-tab-list>
            <base-tab-panels>
                <base-tab-panel class="p-5">
                    <slot name="sponsorForm"></slot>
                </base-tab-panel>
                <base-tab-panel class="p-5">
                    <slot name="incomeForm"></slot>
                </base-tab-panel>

                <base-tab-panel class="p-5">
                    <slot name="secondSponsorForm"></slot>
                </base-tab-panel>

                <base-tab-panel class="p-5">
                    <slot name="spouseForm"></slot>
                </base-tab-panel>
            </base-tab-panels>
        </base-tab-group>

        <slot></slot>
    </div>
</template>
