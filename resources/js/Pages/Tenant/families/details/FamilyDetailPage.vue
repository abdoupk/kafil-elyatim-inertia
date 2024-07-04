<script lang="ts" setup>
import { provide, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import FamilyMenu from '@/Pages/Tenant/families/details/FamilyMenu.vue'
import TheFamilySponsorship from '@/Pages/Tenant/families/details/TheFamilySponsorship.vue'
import TheGeneralInformation from '@/Pages/Tenant/families/details/TheGeneralInformation.vue'
import TheHousingInformation from '@/Pages/Tenant/families/details/TheHousingInformation.vue'
import TheOrphansInformation from '@/Pages/Tenant/families/details/TheOrphansInformation.vue'
import TheOrphansSponsorship from '@/Pages/Tenant/families/details/TheOrphansSponsorship.vue'
import TheReport from '@/Pages/Tenant/families/details/TheReport.vue'
import TheSecondSponsorInformation from '@/Pages/Tenant/families/details/TheSecondSponsorInformation.vue'
import TheSponsorInformation from '@/Pages/Tenant/families/details/TheSponsorInformation.vue'
import TheSponsorSponsorship from '@/Pages/Tenant/families/details/TheSponsorSponsorship.vue'
import TheSpouseInformation from '@/Pages/Tenant/families/details/TheSpouseInformation.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{ family: object }>()

const view = ref('sponsor_information')

function updateView(newValue: string) {
    view.value = newValue
}

provide('familyDetailView', {
    view,
    updateView
})

console.log(props.family)
</script>

<template>
    <div class="flex items-center mt-8 intro-y">
        <h2 class="me-auto text-lg font-medium">Profile Layout</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <family-menu :family></family-menu>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <the-general-information v-if="view === 'general_information'"></the-general-information>

                <the-sponsor-information v-if="view === 'sponsor_information'"></the-sponsor-information>

                <the-housing-information v-if="view === 'housing_information'"></the-housing-information>

                <the-second-sponsor-information
                    v-if="view === 'second_sponsor_information'"
                ></the-second-sponsor-information>

                <the-orphans-information v-if="view === 'orphans_information'"></the-orphans-information>

                <the-report v-if="view === 'the_report'"></the-report>

                <the-family-sponsorship v-if="view === 'family_sponsorship'"></the-family-sponsorship>

                <the-sponsor-sponsorship v-if="view === 'sponsor_sponsorship'"></the-sponsor-sponsorship>

                <the-orphans-sponsorship v-if="view === 'orphans_sponsorship'"></the-orphans-sponsorship>

                <the-spouse-information v-if="view === 'spouse_information'"></the-spouse-information>
            </div>
        </div>
    </div>
</template>
