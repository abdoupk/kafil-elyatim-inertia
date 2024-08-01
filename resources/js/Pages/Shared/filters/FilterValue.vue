<script lang="ts" setup>
import type { FilterValueType } from '@/types/types'

import BranchesFilterDropDown from '@/Pages/Shared/filters/BranchesFilterDropDown.vue'
import FamiliesFilterDropDown from '@/Pages/Shared/filters/FamiliesFilterDropDown.vue'
import SponsorsFilterDropDown from '@/Pages/Shared/filters/SponsorsFilterDropDown.vue'
import ZonesFilterDropDown from '@/Pages/Shared/filters/ZonesFilterDropDown.vue'

defineProps<{ field?: string }>()

const value = defineModel<FilterValueType>('value')
</script>

<template>
    <families-filter-drop-down
        v-if="field === 'family_id'"
        v-model:value="value"
        class="col-span-4 text-sm"
    ></families-filter-drop-down>

    <sponsors-filter-drop-down
        v-if="field === 'sponsor.id'"
        class="col-span-4 text-sm"
        @update:value="value = $event?.id"
    ></sponsors-filter-drop-down>

    <branches-filter-drop-down
        v-if="field === 'branch.id'"
        v-model:value="value"
        class="col-span-4 text-sm"
    ></branches-filter-drop-down>

    <zones-filter-drop-down
        v-if="field === 'zone.id'"
        class="col-span-4 text-sm"
        @update:value="value = $event?.id"
    ></zones-filter-drop-down>
</template>
