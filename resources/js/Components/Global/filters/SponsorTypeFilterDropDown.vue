<script lang="ts" setup>
import type { FilterValueSponsorshipType } from '@/types/types'

import { ref } from 'vue'

import FilterSponsorShipDropDown from '@/Components/Global/filters/FilterSponsorShipDropDown.vue'

import { __ } from '@/utils/i18n'

const value = defineModel<FilterValueSponsorshipType>('value', {
    default: {
        value: '',
        label: __('filters.select_an_option')
    }
})

// TODO change to ارمل ....
const data = ref([
    {
        label: __('father'),
        value: 'father'
    },
    {
        label: __('mother'),
        value: 'mother'
    },
    {
        label: __('grand_father'),
        value: 'grand_father'
    },
    {
        label: __('grand_mother'),
        value: 'grand_mother'
    },
    {
        label: __('other'),
        value: 'other'
    }
])
</script>

<template>
    <filter-sponsor-ship-drop-down v-model:value="value" :data></filter-sponsor-ship-drop-down>
</template>
