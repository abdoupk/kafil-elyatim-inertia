<script lang="ts" setup>
import { useBranchesStore } from '@/stores/branches'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'
import { __ } from '@/utils/i18n'

const value = defineModel<{ id: string; name: string }>('value', {
    default: {
        id: '',
        name: __('filters.select_an_option')
    }
})

const branchesStore = useBranchesStore()

onMounted(() => {
    branchesStore.getBranches()
})
</script>

<template>
    <filter-value-drop-down :data="branchesStore.branches" v-model:value="value"></filter-value-drop-down>
</template>
