<script lang="ts" setup>
import type { FilterValueType } from '@/types/types'

import { ref } from 'vue'

import FilterSponsorShipDropDown from '@/Pages/Shared/filters/FilterSponsorShipDropDown.vue'

import { __ } from '@/utils/i18n'

const value = defineModel<FilterValueType>('value', {
    default: {
        value: '',
        label: __('filters.select_an_option')
    }
})

const data = ref([
    {
        label: __('monthly_allowance'),
        value: 'monthly_allowance'
    },
    {
        label: __('ramadan_basket'),
        value: 'ramadan_basket'
    },
    {
        label: __('zakat'),
        value: 'zakat'
    },
    {
        label: __('housing_assistance'),
        value: 'housing_assistance'
    },
    {
        label: __('eid_el_adha'),
        value: 'eid_el_adha'
    }
])
</script>

<template>
    <filter-sponsor-ship-drop-down v-model:value="value" :data></filter-sponsor-ship-drop-down>
</template>
