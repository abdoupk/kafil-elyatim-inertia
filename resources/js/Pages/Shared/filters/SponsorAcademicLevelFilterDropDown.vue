<script lang="ts" setup>
import type { FilterValueType } from '@/types/types'

import { useAcademicLevelsStore } from '@/stores/academic-level'
import { onMounted, ref } from 'vue'

import FilterValueDropDown from '@/Pages/Shared/filters/FilterValueDropDown.vue'

import { __ } from '@/utils/i18n'

const value = defineModel<FilterValueType>('value', {
    default: {
        id: '',
        name: __('filters.select_an_option')
    }
})

const academicLevelsStore = useAcademicLevelsStore()

const data = ref([])

onMounted(async () => {
    await academicLevelsStore.getAcademicLevelsForOrphansForSelectFilterValue().then((res) => {
        data.value = res
    })
})
</script>

<template>
    <filter-value-drop-down v-model:value="value" :data></filter-value-drop-down>
</template>
