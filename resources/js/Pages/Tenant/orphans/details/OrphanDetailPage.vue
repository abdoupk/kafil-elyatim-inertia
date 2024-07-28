<script lang="ts" setup>
import type { OrphanShowType } from '@/types/orphans'

import { provide, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import AcademicAchievement from '@/Pages/Tenant/orphans/details/AcademicAchievement.vue'
import GeneralInformation from '@/Pages/Tenant/orphans/details/GeneralInformation.vue'
import OrphanMenu from '@/Pages/Tenant/orphans/details/OrphanMenu.vue'
import SponsorshipsInformation from '@/Pages/Tenant/orphans/details/SponsorshipsInformation.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    orphan: OrphanShowType
}>()

console.log(props.orphan)

const view = ref('general_information')

function updateView(newValue: string) {
    view.value = newValue
}

// eslint-disable-next-line capitalized-comments
// noinspection JSUnusedGlobalSymbols
provide('orphanDetailView', { view, updateView })
</script>

<template>
    <div class="flex items-center mt-8 intro-y">
        <h2 class="me-auto text-lg font-medium ltr:capitalize">
            {{ $t('orphan details') }}
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <orphan-menu :orphan></orphan-menu>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <general-information v-if="view === 'general_information'" :orphan></general-information>

                <sponsorships-information v-if="view === 'sponsorships_information'" :orphan></sponsorships-information>

                <academic-achievement v-if="view === 'academic_achievement'" :orphan></academic-achievement>
            </div>
        </div>
    </div>
</template>
