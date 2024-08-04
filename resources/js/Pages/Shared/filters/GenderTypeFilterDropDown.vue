<script lang="ts" setup>
import type { FilterValueSponsorshipType } from '@/types/types'

import { ref } from 'vue'

import FilterSponsorShipDropDown from '@/Pages/Shared/filters/FilterSponsorShipDropDown.vue'

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
        label: __('male'),
        value: 'male'
    },
    {
        label: __('female'),
        value: 'female'
    }
])
</script>

<template>
    <filter-sponsor-ship-drop-down v-model:value="value" :data></filter-sponsor-ship-drop-down>
</template>
