<script setup lang="ts">
import BranchesFilterDropDown from '@/Pages/Shared/filters/BranchesFilterDropDown.vue'
import FamiliesFilterDropDown from '@/Pages/Shared/filters/FamiliesFilterDropDown.vue'
import SponsorsFilterDropDown from '@/Pages/Shared/filters/SponsorsFilterDropDown.vue'
import ZonesFilterDropDown from '@/Pages/Shared/filters/ZonesFilterDropDown.vue'

defineProps<{ field?: string }>()

const value = defineModel<string>('value')
</script>

<template>
    <families-filter-drop-down
        v-if="field === 'family_id'"
        @update:value="value = $event?.id"
        class="col-span-4 text-sm"
    ></families-filter-drop-down>

    <sponsors-filter-drop-down
        v-if="field === 'sponsor.id'"
        @update:value="value = $event?.id"
        class="col-span-4 text-sm"
    ></sponsors-filter-drop-down>

    <branches-filter-drop-down
        v-if="field === 'branch.id'"
        @update:value="value = $event?.id"
        class="col-span-4 text-sm"
    ></branches-filter-drop-down>

    <zones-filter-drop-down
        v-if="field === 'zone.id'"
        @update:value="value = $event?.id"
        class="col-span-4 text-sm"
    ></zones-filter-drop-down>
</template>
