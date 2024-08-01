<script lang="ts" setup>
import { useZonesStore } from '@/stores/zones'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

const value = defineModel<{ id: string; name: string }>('value', {
    default: {
        id: '',
        name: ''
    }
})

const zonesStore = useZonesStore()

onMounted(() => {
    zonesStore.getZones()
})
</script>

<template>
    <filter-value-drop-down :data="zonesStore.zones" v-model:value="value"></filter-value-drop-down>
</template>
