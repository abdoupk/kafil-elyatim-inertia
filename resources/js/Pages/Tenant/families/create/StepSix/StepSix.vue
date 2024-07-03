<script lang="ts" setup>
import type { CreateFamilyStepProps } from '@/types/types'

import BaseTab from '@/Components/Base/headless/Tab/BaseTab.vue'
import BaseTabButton from '@/Components/Base/headless/Tab/BaseTabButton.vue'
import BaseTabGroup from '@/Components/Base/headless/Tab/BaseTabGroup.vue'
import BaseTabList from '@/Components/Base/headless/Tab/BaseTabList.vue'
import BaseTabPanel from '@/Components/Base/headless/Tab/BaseTabPanel.vue'
import BaseTabPanels from '@/Components/Base/headless/Tab/BaseTabPanels.vue'

defineProps<CreateFamilyStepProps>()
</script>

<template>
    <div
        v-if="currentStep === 6"
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
    >
        <div class="text-lg font-medium hidden lg:block mb-6">
            {{ $t('families.create_family.stepSix') }}
        </div>

        <base-tab-group class="mt-5">
            <base-tab-list variant="link-tabs">
                <base-tab>
                    <base-tab-button as="button" class="w-full py-2" type="button">
                        {{ $t('sponsorship for the family') }}
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button as="button" class="w-full py-2" type="button">
                        {{ $t('sponsorship for the sponsor') }}
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button as="button" class="w-full py-2" type="button">
                        {{ $t('sponsorship for the orphans') }}
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
