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

const data = ref([
    {
        label: __('medical_sponsorship'),
        value: 'medical_sponsorship'
    },
    {
        label: __('university_scholarship'),
        value: 'university_scholarship'
    },
    {
        label: __('association_trips'),
        value: 'association_trips'
    },
    {
        label: __('summer_camp'),
        value: 'summer_camp'
    },
    {
        label: __('eid_suit'),
        value: 'eid_suit'
    },
    {
        label: __('private_lessons'),
        value: 'private_lessons'
    },
    {
        label: __('school_bag'),
        value: 'school_bag'
    }
])
</script>

<template>
    <filter-sponsor-ship-drop-down v-model:value="value" :data></filter-sponsor-ship-drop-down>
</template>
