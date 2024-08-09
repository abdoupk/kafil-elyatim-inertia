<script lang="ts" setup>
import type { FilterValueType } from '@/types/types'

import { useBranchesStore } from '@/stores/branches'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

import { __ } from '@/utils/i18n'

const value = defineModel<FilterValueType>('value', {
    default: {
        id: '',
        name: __('filters.select_an_option')
    }
})

const branchesStore = useBranchesStore()

onMounted(() => {
    if (branchesStore.branches.length === 0) {
        branchesStore.getBranches()
    }
})
</script>

<template>
    <filter-value-drop-down :data="branchesStore.branches" v-model:value="value"></filter-value-drop-down>
</template>
