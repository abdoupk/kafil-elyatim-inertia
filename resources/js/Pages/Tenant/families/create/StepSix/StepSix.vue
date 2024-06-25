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

const props = defineProps<CreateFamilyStepProps>()

const checkErrors = (pattern: string) => {
    const regex = new RegExp(pattern)

    return (
        props.form?.errors &&
        Object.keys(props.form.errors).some((error) => {
            if (regex.test(error)) return true
        })
    )
}

const familySponsorShipErrors = computed(() => {
    return checkErrors('^sponsor')
})

const sponsorSponsorShipErrors = computed(() => {
    return checkErrors('^second_sponsor')
})

const orphansSponsorShipErrors = computed(() => {
    return checkErrors('^income')
})
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
        v-if="currentStep === 6"
    >
        <div class="text-base font-medium">
            {{ $t('auth.register.stepTwo.title') }}
        </div>

        <base-tab-group class="mt-5">
            <base-tab-list variant="link-tabs">
                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('sponsorship for the family') }}

                        <svg-loader
                            v-if="familySponsorShipErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('sponsorship for the sponsor') }}

                        <svg-loader
                            v-if="sponsorSponsorShipErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('sponsorship for the orphans') }}

                        <svg-loader
                            v-if="orphansSponsorShipErrors"
                            name="icon-circle-exclamation"
                            class="fill-red-500 inline ms-4"
                        ></svg-loader>
                    </base-tab-button>
                </base-tab>
            </base-tab-list>

            <base-tab-panels>
                <base-tab-panel class="p-5">
                    <slot name="FamilySponsorShipForm"></slot>
                </base-tab-panel>

                <base-tab-panel class="p-5">
                    <slot name="SponsorSponsorShipForm"></slot>
                </base-tab-panel>

                <base-tab-panel class="p-5">
                    <slot name="OrphansSponsorShipForm"></slot>
                </base-tab-panel>
            </base-tab-panels>
        </base-tab-group>

        <slot></slot>
    </div>
</template>
