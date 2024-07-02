<script setup lang="ts">
import type { CreateFamilyStepProps } from '@/types/types'

import BaseTab from '@/Components/Base/headless/Tab/BaseTab.vue'
import BaseTabButton from '@/Components/Base/headless/Tab/BaseTabButton.vue'
import BaseTabGroup from '@/Components/Base/headless/Tab/BaseTabGroup.vue'
import BaseTabList from '@/Components/Base/headless/Tab/BaseTabList.vue'
import BaseTabPanel from '@/Components/Base/headless/Tab/BaseTabPanel.vue'
import BaseTabPanels from '@/Components/Base/headless/Tab/BaseTabPanels.vue'
import { computed } from 'vue'
import { checkErrors } from '@/utils/helper'
import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<CreateFamilyStepProps>()

const housingErrors = computed(() => {
    return checkErrors('^housing', props?.form?.errors)
})

const otherPropertiesErrors = computed(() => {
    return checkErrors('other_properties$', props?.form?.errors)
})

const furnishingsErrors = computed(() => {
    return checkErrors('^furnishings', props?.form?.errors)
})
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
        v-if="currentStep === 4"
    >
        <div class="text-base font-medium">
            {{ $t('auth.register.stepTwo.title') }}
        </div>

        <base-tab-group class="mt-5">
            <base-tab-list variant="link-tabs">
                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('housing information') }}

                        <svg-loader
                            v-if="housingErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('furnishing information') }}

                        <svg-loader
                            v-if="furnishingsErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('other_properties') }}

                        <svg-loader
                            v-if="otherPropertiesErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>
            </base-tab-list>

            <base-tab-panels>
                <base-tab-panel class="p-5">
                    <slot name="housingForm"></slot>
                </base-tab-panel>

                <base-tab-panel class="p-5">
                    <slot name="furnishingForm"></slot>
                </base-tab-panel>

                <base-tab-panel class="p-5">
                    <slot name="otherPropertiesForm"></slot>
                </base-tab-panel>
            </base-tab-panels>
        </base-tab-group>

        <slot></slot>
    </div>
</template>
