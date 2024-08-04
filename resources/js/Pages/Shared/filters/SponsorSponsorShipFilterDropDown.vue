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

const data = ref([
    {
        label: __('medical_sponsorship'),
        value: 'medical_sponsorship'
    },
    {
        label: __('literacy_lessons'),
        value: 'literacy_lessons'
    },
    {
        label: __('direct_sponsorship'),
        value: 'direct_sponsorship'
    },
    {
        label: __('project_support'),
        value: 'project_support'
    }
])
</script>

<template>
    <filter-sponsor-ship-drop-down v-model:value="value" :data></filter-sponsor-ship-drop-down>
</template>
