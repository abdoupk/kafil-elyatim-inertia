<script setup lang="ts">
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import ThePagination from '@/Components/pagination/ThePagination.vue'

const emit = defineEmits(['changePage'])

defineProps<{ pages: number }>()

const page = defineModel('page', { default: 1 })

const perPage = defineModel('perPage')
</script>

<template>
    <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
        <the-pagination :pages :range-size="3" v-model="page" @update:model-value="emit('changePage', $event)">
        </the-pagination>

        <base-form-select class="!box mt-3 w-20 sm:mt-0" v-model="perPage">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="35">35</option>
            <option value="50">50</option>
        </base-form-select>
    </div>
</template>
