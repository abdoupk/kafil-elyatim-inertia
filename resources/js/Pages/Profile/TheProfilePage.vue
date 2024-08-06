<script lang="ts" setup>
import { provide, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheAccountForm from '@/Pages/Profile/TheAccountForm.vue'
import TheAppearanceForm from '@/Pages/Profile/TheAppearanceForm.vue'
import TheNotificationsForm from '@/Pages/Profile/TheNotificationsForm.vue'

import BaseTab from '@/Components/Base/headless/Tab/BaseTab.vue'
import BaseTabButton from '@/Components/Base/headless/Tab/BaseTabButton.vue'
import BaseTabGroup from '@/Components/Base/headless/Tab/BaseTabGroup.vue'
import BaseTabList from '@/Components/Base/headless/Tab/BaseTabList.vue'
import BaseTabPanel from '@/Components/Base/headless/Tab/BaseTabPanel.vue'
import BaseTabPanels from '@/Components/Base/headless/Tab/BaseTabPanels.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

defineOptions({
    layout: TheLayout
})

const view = ref('account')

function updateView(newValue: string) {
    view.value = newValue
}

// eslint-disable-next-line capitalized-comments
// noinspection JSUnusedGlobalSymbols
provide('profileView', { view, updateView })
</script>

<template>
    <div class="flex items-center mt-8 intro-y">
        <h2 class="me-auto text-lg font-medium ltr:capitalize">{{ $t('breadcrumb.profile') }}</h2>
    </div>

    <base-tab-group class="grid grid-cols-12 w-5/6 gap-6 mt-5 box p-5" vertical>
        <div class="col-span-3 text-base/relaxed">
            <base-tab-list variant="pills">
                <base-tab>
                    <base-tab-button
                        as="button"
                        class="w-full flex items-center content-around justify-center py-2"
                        type="button"
                    >
                        <svg-loader name="icon-user"></svg-loader>

                        <span class="ms-2"> {{ $t('account') }}</span>
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button
                        as="button"
                        class="flex items-center content-around justify-center w-full py-2"
                        type="button"
                    >
                        <svg-loader name="icon-brush"></svg-loader>

                        <span class="ms-2"> {{ $t('appearance') }}</span>
                    </base-tab-button>
                </base-tab>

                <base-tab>
                    <base-tab-button
                        as="button"
                        class="flex items-center content-around justify-center w-full py-2"
                        type="button"
                    >
                        <svg-loader class="ms-3.5" name="icon-bell"></svg-loader>

                        <span class="ms-2"> {{ $t('notifications') }}</span>
                    </base-tab-button>
                </base-tab>
            </base-tab-list>
        </div>

        <div class="col-span-8">
            <base-tab-panels>
                <base-tab-panel>
                    <the-account-form></the-account-form>
                </base-tab-panel>

                <base-tab-panel>
                    <the-appearance-form></the-appearance-form>
                </base-tab-panel>

                <base-tab-panel>
                    <the-notifications-form></the-notifications-form>
                </base-tab-panel>
            </base-tab-panels>
        </div>
    </base-tab-group>
</template>
