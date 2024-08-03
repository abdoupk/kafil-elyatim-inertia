<script lang="ts" setup>
import type { FilterValueType, ListBoxFilter } from '@/types/types'

import BranchesFilterDropDown from '@/Pages/Shared/filters/BranchesFilterDropDown.vue'
import FamiliesFilterDropDown from '@/Pages/Shared/filters/FamiliesFilterDropDown.vue'
import FamilySponsorShipFilterDropDown from '@/Pages/Shared/filters/FamilySponsorShipFilterDropDown.vue'
import OrphanAcademicLevelFilterDropDown from '@/Pages/Shared/filters/OrphanAcademicLevelFilterDropDown.vue'
import OrphanSponsorShipFilterDropDown from '@/Pages/Shared/filters/OrphanSponsorShipFilterDropDown.vue'
import SponsorAcademicLevelFilterDropDown from '@/Pages/Shared/filters/SponsorAcademicLevelFilterDropDown.vue'
import SponsorSponsorShipFilterDropDown from '@/Pages/Shared/filters/SponsorSponsorShipFilterDropDown.vue'
import SponsorsFilterDropDown from '@/Pages/Shared/filters/SponsorsFilterDropDown.vue'
import ZonesFilterDropDown from '@/Pages/Shared/filters/ZonesFilterDropDown.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'

defineProps<{ field?: ListBoxFilter }>()

const value = defineModel<FilterValueType>('value')
</script>

<template>
    <template v-if="field?.type === 'object'">
        <families-filter-drop-down
            v-if="field?.label === 'family'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></families-filter-drop-down>

        <sponsors-filter-drop-down
            v-else-if="field?.label === 'sponsor'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></sponsors-filter-drop-down>

        <branches-filter-drop-down
            v-else-if="field?.label === 'branch'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></branches-filter-drop-down>

        <zones-filter-drop-down
            v-else-if="field?.label === 'zone'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></zones-filter-drop-down>

        <sponsor-academic-level-filter-drop-down
            v-else-if="field?.label === 'sponsor_academic_level'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></sponsor-academic-level-filter-drop-down>

        <orphan-academic-level-filter-drop-down
            v-else-if="field?.label === 'orphan_academic_level'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></orphan-academic-level-filter-drop-down>

        <family-sponsor-ship-filter-drop-down
            v-if="field?.label === 'family_sponsorships'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></family-sponsor-ship-filter-drop-down>

        <sponsor-sponsor-ship-filter-drop-down
            v-if="field?.label === 'sponsor_sponsorships'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></sponsor-sponsor-ship-filter-drop-down>

        <orphan-sponsor-ship-filter-drop-down
            v-if="field?.label === 'orphan_sponsorships'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></orphan-sponsor-ship-filter-drop-down>
    </template>

    <template v-else-if="field?.type === 'date'">
        <div class="col-span-4 mt-2">
            <base-v-calendar v-model="value"></base-v-calendar>
        </div>
    </template>

    <base-form-input
        v-else-if="field?.type === 'string'"
        v-model="value"
        class="col-span-4 mt-2 text-sm"
        type="text"
    ></base-form-input>

    <base-form-input
        v-else-if="field?.type === 'number'"
        v-model="value"
        class="col-span-4 mt-2 text-sm"
        type="number"
    ></base-form-input>
</template>
