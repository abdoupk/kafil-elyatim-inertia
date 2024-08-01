<script lang="ts" setup>
import { useBranchesStore } from '@/stores/branches'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

const value = defineModel<{ id: string; name: string }>('value', {
    default: {
        id: '',
        name: ''
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
