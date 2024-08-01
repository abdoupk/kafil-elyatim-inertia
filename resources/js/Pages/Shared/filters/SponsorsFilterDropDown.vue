<script lang="ts" setup>
import type { FilterValueType } from '@/types/types'

import { useSponsorsStore } from '@/stores/sponsors'
import { onMounted } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

const value = defineModel<FilterValueType>('value', {
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
    <filter-value-drop-down v-model:value="value" :data="sponsorsStore.sponsors"></filter-value-drop-down>
</template>
