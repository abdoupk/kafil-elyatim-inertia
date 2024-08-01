<script lang="ts" setup>
import type { FilterValueType } from '@/types/types'

import { useFamiliesStore } from '@/stores/families'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

import { __ } from '@/utils/i18n'

const value = defineModel<FilterValueType>('value', {
    default: {
        id: '',
        name: __('filters.select_an_option')
    }
})

const familiesStore = useFamiliesStore()

onMounted(() => {
    if (familiesStore.families.length === 0) {
        familiesStore.getFamilies()
    }
})
</script>

<template>
    <filter-value-drop-down v-model:value="value" :data="familiesStore.families"></filter-value-drop-down>
</template>
