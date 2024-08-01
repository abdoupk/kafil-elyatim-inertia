<script lang="ts" setup>
import type { FilterValueType, ListBoxFilter } from '@/types/types'

import BranchesFilterDropDown from '@/Pages/Shared/filters/BranchesFilterDropDown.vue'
import FamiliesFilterDropDown from '@/Pages/Shared/filters/FamiliesFilterDropDown.vue'
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
            v-if="field.field === 'family_id'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></families-filter-drop-down>

        <sponsors-filter-drop-down
            v-else-if="field.field === 'sponsor.id'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></sponsors-filter-drop-down>

        <branches-filter-drop-down
            v-else-if="field.field === 'branch.id'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></branches-filter-drop-down>

        <zones-filter-drop-down
            v-else-if="field.field === 'zone.id'"
            v-model:value="value"
            class="col-span-4 text-sm"
        ></zones-filter-drop-down>
    </template>

    <template v-else-if="field?.type === 'date'">
        <div class="col-span-4 mt-2">
            <base-v-calendar v-model="value"></base-v-calendar>
        </div>
    </template>

    <base-form-input v-else v-model="value" class="col-span-4 mt-2 text-sm"></base-form-input>
</template>
