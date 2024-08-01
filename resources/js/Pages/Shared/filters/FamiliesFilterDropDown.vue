<script lang="ts" setup>
import { useFamiliesStore } from '@/stores/families'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

const value = defineModel<{ id: string; name: string }>('value', {
    default: {
        id: '',
        name: ''
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
    <filter-value-drop-down :data="familiesStore.families" v-model:value="value"></filter-value-drop-down>
</template>
