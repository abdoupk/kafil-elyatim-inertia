<script lang="ts" setup>
import type { FilterValueType, ListBoxFilter } from '@/types/types'

import TheBranchSelector from '@/Pages/Shared/TheBranchSelector.vue'
import BranchesFilterDropDown from '@/Pages/Shared/filters/BranchesFilterDropDown.vue'
import ClothesSizeFilterDropDown from '@/Pages/Shared/filters/ClothesSizeFilterDropDown.vue'
import FamiliesFilterDropDown from '@/Pages/Shared/filters/FamiliesFilterDropDown.vue'
import FamilySponsorShipFilterDropDown from '@/Pages/Shared/filters/FamilySponsorShipFilterDropDown.vue'
import GenderTypeFilterDropDown from '@/Pages/Shared/filters/GenderTypeFilterDropDown.vue'
import OrphanAcademicLevelFilterDropDown from '@/Pages/Shared/filters/OrphanAcademicLevelFilterDropDown.vue'
import OrphanSponsorShipFilterDropDown from '@/Pages/Shared/filters/OrphanSponsorShipFilterDropDown.vue'
import OrphansFilterDropDown from '@/Pages/Shared/filters/OrphansFilterDropDown.vue'
import ShoesSizeFilterDropDown from '@/Pages/Shared/filters/ShoesSizeFilterDropDown.vue'
import SponsorAcademicLevelFilterDropDown from '@/Pages/Shared/filters/SponsorAcademicLevelFilterDropDown.vue'
import SponsorSponsorShipFilterDropDown from '@/Pages/Shared/filters/SponsorSponsorShipFilterDropDown.vue'
import SponsorTypeFilterDropDown from '@/Pages/Shared/filters/SponsorTypeFilterDropDown.vue'
import SponsorsFilterDropDown from '@/Pages/Shared/filters/SponsorsFilterDropDown.vue'
import ZonesFilterDropDown from '@/Pages/Shared/filters/ZonesFilterDropDown.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'

defineProps<{ field?: ListBoxFilter }>()

const value = defineModel<FilterValueType>('value')
</script>

<template>
    <div class="col-span-6 md:col-span-4">
        <template v-if="field?.type === 'object'">
            <families-filter-drop-down
                v-if="field?.label === 'family'"
                v-model:value="value"
                class="text-sm"
            ></families-filter-drop-down>

            <sponsors-filter-drop-down
                v-else-if="field?.label === 'sponsor'"
                v-model:value="value"
                class="text-sm"
            ></sponsors-filter-drop-down>

            <orphans-filter-drop-down
                v-else-if="field?.label === 'orphan'"
                v-model:value="value"
                class="text-sm"
            ></orphans-filter-drop-down>

            <branches-filter-drop-down
                v-else-if="field?.label === 'branch'"
                v-model:value="value"
                class="text-sm"
            ></branches-filter-drop-down>

            <zones-filter-drop-down
                v-else-if="field?.label === 'zone'"
                v-model:value="value"
                class="text-sm"
            ></zones-filter-drop-down>

            <shoes-size-filter-drop-down
                v-else-if="field?.label === 'shoes_size'"
                v-model:value="value"
                class="text-sm"
            ></shoes-size-filter-drop-down>

            <clothes-size-filter-drop-down
                v-else-if="field?.label === 'pants_size' || field?.label === 'shirt_size'"
                v-model:value="value"
                class="text-sm"
            ></clothes-size-filter-drop-down>

            <sponsor-academic-level-filter-drop-down
                v-else-if="field?.label === 'sponsor_academic_level' || field?.label === 'sponsor.academic_level'"
                v-model:value="value"
                class="text-sm"
            ></sponsor-academic-level-filter-drop-down>

            <orphan-academic-level-filter-drop-down
                v-else-if="field?.label === 'orphan_academic_level' || field?.label === 'orphan.academic_level'"
                v-model:value="value"
                class="text-sm"
            ></orphan-academic-level-filter-drop-down>

            <family-sponsor-ship-filter-drop-down
                v-if="field?.label === 'family_sponsorships'"
                v-model:value="value"
                class="text-sm"
            ></family-sponsor-ship-filter-drop-down>

            <sponsor-sponsor-ship-filter-drop-down
                v-if="field?.label === 'sponsor_sponsorships'"
                v-model:value="value"
                class="text-sm"
            ></sponsor-sponsor-ship-filter-drop-down>

            <orphan-sponsor-ship-filter-drop-down
                v-if="field?.label === 'orphan_sponsorships'"
                v-model:value="value"
                class="text-sm"
            ></orphan-sponsor-ship-filter-drop-down>

            <sponsor-type-filter-drop-down
                v-if="field?.label === 'sponsor_type'"
                v-model:value="value"
                class="text-sm"
            ></sponsor-type-filter-drop-down>

            <gender-type-filter-drop-down
                v-if="field?.label === 'gender'"
                v-model:value="value"
                class="text-sm"
            ></gender-type-filter-drop-down>
        </template>

        <template v-else-if="field?.type === 'date'">
            <div class="mt-2">
                <base-v-calendar v-model="value"></base-v-calendar>
            </div>
        </template>

        <base-form-input
            v-else-if="field?.type === 'string'"
            v-model="value"
            :placeholder="
                $t('auth.placeholders.fill', {
                    attribute: $t('the_value')
                })
            "
            class="mt-2 text-sm"
            type="text"
        ></base-form-input>

        <base-form-input
            v-else-if="field?.type === 'number'"
            v-model="value"
            :placeholder="
                $t('auth.placeholders.fill', {
                    attribute: $t('the_value')
                })
            "
            class="mt-2 text-sm"
            type="number"
        ></base-form-input>
    </div>
    <the-branch-selector></the-branch-selector>
</template>
