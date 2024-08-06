<script lang="ts" setup>
import { provide, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import ProfileMenu from '@/Pages/Profile/ProfileMenu.vue'

import BaseTab from '@/Components/Base/headless/Tab/BaseTab.vue'
import BaseTabButton from '@/Components/Base/headless/Tab/BaseTabButton.vue'
import BaseTabGroup from '@/Components/Base/headless/Tab/BaseTabGroup.vue'
import BaseTabList from '@/Components/Base/headless/Tab/BaseTabList.vue'
import BaseTabPanel from '@/Components/Base/headless/Tab/BaseTabPanel.vue'
import BaseTabPanels from '@/Components/Base/headless/Tab/BaseTabPanels.vue'

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

    <div class="grid grid-cols-12 gap-6 mt-5">
        <profile-menu></profile-menu>

        <div class="col-span-12 lg:col-span-9 2xl:col-span-9">
            <div class="">
                <base-tab-group class="grid grid-cols-12 gap-6" vertical>
                    <div class="col-span-3">
                        <base-tab-list variant="pills">
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
                    </div>

                    <div class="col-span-6">
                        <base-tab-panels>
                            <base-tab-panel class="p-5"> 555</base-tab-panel>

                            <base-tab-panel class="p-5"> 666</base-tab-panel>

                            <base-tab-panel class="p-5"> 777</base-tab-panel>
                        </base-tab-panels>
                    </div>
                </base-tab-group>

                <!--                <the-account-form v-if="view === 'account'"></the-account-form>-->

                <!--                <the-notifications-form v-if="view === 'notifications'"></the-notifications-form>-->

                <!--                <the-appearance-form v-if="view === 'appearance'"></the-appearance-form>-->
            </div>
        </div>
    </div>
</template>
