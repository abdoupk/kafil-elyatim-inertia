<script lang="ts" setup>
import { onMounted } from 'vue'
import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'
import { useFamiliesStore } from '@/stores/families'

const value = defineModel<{ id: string; name: string }>('value', {
    default: {
        id: '',
        name: ''
    }
})
const familiesStore = useFamiliesStore()

onMounted(() => {
    familiesStore.getFamilies()
})
</script>

<template>
    <filter-value-drop-down :data="familiesStore.families" v-model:value="value"></filter-value-drop-down>
</template>
