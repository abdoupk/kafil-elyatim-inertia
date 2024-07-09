<script lang="ts" setup>
import type { SponsorShowType } from '@/types/sponsors'

import { provide, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import GeneralInformation from '@/Pages/Tenant/sponsors/details/GeneralInformation.vue'
import IncomesInformation from '@/Pages/Tenant/sponsors/details/IncomesInformation.vue'
import SponsorMenu from '@/Pages/Tenant/sponsors/details/SponsorMenu.vue'
import SponsorshipsInformation from '@/Pages/Tenant/sponsors/details/SponsorshipsInformation.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{
    sponsor: SponsorShowType
}>()

const view = ref('general_information')

function updateView(newValue: string) {
    view.value = newValue
}

// eslint-disable-next-line capitalized-comments
// noinspection JSUnusedGlobalSymbols
provide('sponsorDetailView', { view, updateView })
</script>

<template>
    <div class="flex items-center mt-8 intro-y">
        <h2 class="me-auto text-lg font-medium ltr:capitalize">
            {{ $t('family details') }}
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <sponsor-menu :sponsor></sponsor-menu>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <general-information v-if="view === 'general_information'" :sponsor></general-information>

                <sponsorships-information
                    v-if="view === 'sponsorships_information'"
                    :sponsor
                ></sponsorships-information>

                <incomes-information v-if="view === 'incomes_information'" :sponsor></incomes-information>
            </div>
        </div>
    </div>
</template>
