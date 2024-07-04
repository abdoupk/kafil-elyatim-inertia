<script lang="ts" setup>
import TheLayout from '@/Layouts/TheLayout.vue'
import FamilyMenu from '@/Pages/Tenant/families/details/FamilyMenu.vue'
import GeneralInformation from '@/Pages/Tenant/families/details/GeneralInformation.vue'
import { provide, ref } from 'vue'
import SponsorInformation from '@/Pages/Tenant/families/details/SponsorInformation.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{ family: object }>()

const view = ref('sponsor_information')

function updateView(newValue: string) {
    view.value = newValue
}

provide('familyDetailView', {
    view,
    updateView
})
</script>

<template>
    <div class="flex items-center mt-8 intro-y">
        <h2 class="me-auto text-lg font-medium">Profile Layout</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <family-menu :family></family-menu>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <general-information v-if="view === 'general_information'"></general-information>

                <sponsor-information v-if="view === 'sponsor_information'"></sponsor-information>
            </div>
        </div>
    </div>
</template>
