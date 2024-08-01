<script lang="ts" setup>
import { useSponsorsStore } from '@/stores/sponsors'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

const value = defineModel<{ id: string; name: string }>('value', {
    default: {
        id: '',
        name: ''
    }
})

const sponsorsStore = useSponsorsStore()

onMounted(() => {
    if (sponsorsStore.sponsors.length === 0) {
        sponsorsStore.getSponsors()
    }
})
</script>

<template>
    <filter-value-drop-down :data="sponsorsStore.sponsors" v-model:value="value"></filter-value-drop-down>
</template>
