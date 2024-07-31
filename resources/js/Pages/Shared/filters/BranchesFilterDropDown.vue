<script lang="ts" setup>
import { onMounted } from 'vue'
import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'
import { useBranchesStore } from '@/stores/branches'

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
