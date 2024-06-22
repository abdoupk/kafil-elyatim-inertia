<script setup lang="ts">
import type { CreateFamilyStepProps } from '@/types/types'

import BaseTab from '@/Components/Base/headless/Tab/BaseTab.vue'
import BaseTabButton from '@/Components/Base/headless/Tab/BaseTabButton.vue'
import BaseTabGroup from '@/Components/Base/headless/Tab/BaseTabGroup.vue'
import BaseTabList from '@/Components/Base/headless/Tab/BaseTabList.vue'
import BaseTabPanel from '@/Components/Base/headless/Tab/BaseTabPanel.vue'
import BaseTabPanels from '@/Components/Base/headless/Tab/BaseTabPanels.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
import BaseFormSwitchLabel from '@/Components/Base/form/form-switch/BaseFormSwitchLabel.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseInputGroup from '@/Components/Base/form/InputGroup/BaseInputGroup.vue'
import BaseInputGroupText from '@/Components/Base/form/InputGroup/BaseInputGroupText.vue'

defineProps<CreateFamilyStepProps>()
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
                    </base-tab-button>
                </base-tab>
                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('income information') }}
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('second sponsor information') }}
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button class="w-full py-2" as="button" type="button">
                        {{ $t('spouse information') }}
                    </base-tab-button>
                </base-tab>
            </base-tab-list>
            <base-tab-panels>
                <base-tab-panel class="p-5">
                    <slot name="sponsorForm"></slot>
                </base-tab-panel>
                <base-tab-panel class="p-5 leading-relaxed">
                    <base-form-switch>
                        <base-form-switch-input id="checkbox-switch-7" type="checkbox" />
                        <base-form-switch-label htmlFor="checkbox-switch-7">
                            Default switch checkbox input
                        </base-form-switch-label>
                    </base-form-switch>

                    <div class="flex gap-6 mt-4">
                        <base-form-switch class="text-lg">
                            <base-form-switch-input id="checkbox-switch-7" type="checkbox" />
                            <base-form-switch-label htmlFor="checkbox-switch-7">
                                Default switch checkbox input
                            </base-form-switch-label>
                        </base-form-switch>
                        <base-input-group>
                            <base-form-input type="text" placeholder="Price" />
                            <base-input-group-text id="input-group-price"> .00</base-input-group-text>
                        </base-input-group>

                    </div>
                </base-tab-panel>
            </base-tab-panels>
        </base-tab-group>

        <slot></slot>
    </div>
</template>
