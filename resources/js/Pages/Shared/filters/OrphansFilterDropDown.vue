<script lang="ts" setup>
import { useOrphansStore } from '@/stores/orphans'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

const value = defineModel<{ id: string; name: string }>('value', {
    default: {
        id: '',
        name: ''
    }
})

const orphansStore = useOrphansStore()

onMounted(() => {
    orphansStore.getOrphans()
})
</script>

<template>
    <filter-value-drop-down :data="orphansStore.orphans" v-model:value="value"></filter-value-drop-down>
</template>
