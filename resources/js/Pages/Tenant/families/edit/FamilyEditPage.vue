<script lang="ts" setup>
import type { FamilyEditType } from '@/types/families'

import { provide, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import FamilyMenu from '@/Pages/Tenant/families/edit/FamilyMenu.vue'
import TheFamilySponsorship from '@/Pages/Tenant/families/edit/TheFamilySponsorship.vue'
import TheGeneralInformation from '@/Pages/Tenant/families/edit/TheGeneralInformation.vue'
import TheHousingInformation from '@/Pages/Tenant/families/edit/TheHousingInformation.vue'
import TheReport from '@/Pages/Tenant/families/edit/TheReport.vue'
import TheSecondSponsorInformation from '@/Pages/Tenant/families/edit/TheSecondSponsorInformation.vue'
import TheSpouseInformation from '@/Pages/Tenant/families/edit/TheSpouseInformation.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{ family: FamilyEditType }>()

const view = ref('general_information')

function updateView(newValue: string) {
    view.value = newValue
}

// eslint-disable-next-line capitalized-comments
// noinspection JSUnusedGlobalSymbols
provide('familyEditView', { view, updateView })
</script>

<template>
    <div class="flex items-center mt-8 intro-y">
        <h2 class="me-auto text-lg font-medium ltr:capitalize">{{ $t('family edit') }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <family-menu :family></family-menu>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <the-general-information v-if="view === 'general_information'" :family></the-general-information>

                <the-housing-information
                    v-if="view === 'housing_information'"
                    :furnishings="family.furnishings"
                    :housing="{ ...family.housing, family_id: family.id }"
                ></the-housing-information>

                <the-second-sponsor-information
                    v-if="view === 'second_sponsor_information'"
                    :second-sponsor="{ ...family.second_sponsor, family_id: family.id }"
                ></the-second-sponsor-information>

                <the-report
                    v-if="view === 'the_report'"
                    :preview="{ ...family.preview, family_id: family.id }"
                ></the-report>

                <the-family-sponsorship
                    v-if="view === 'family_sponsorship'"
                    :sponsorships="{ ...family.family_sponsorships, family_id: family.id }"
                ></the-family-sponsorship>

                <the-spouse-information
                    v-if="view === 'spouse_information'"
                    :spouse="{ ...family.spouse, family_id: family.id }"
                ></the-spouse-information>
            </div>
        </div>
    </div>
</template>
