<script setup lang="ts">
import { ref, watch } from 'vue'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseMenu from '@/Components/Base/headless/Menu/BaseMenu.vue'
import BaseMenuButton from '@/Components/Base/headless/Menu/BaseMenuButton.vue'
import BaseMenuItem from '@/Components/Base/headless/Menu/BaseMenuItem.vue'
import BaseMenuItems from '@/Components/Base/headless/Menu/BaseMenuItems.vue'
import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import type { PaginationData } from '@/types/types'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheLayout from '@/Layouts/TheLayout.vue'
import ThePagination from '@/Components/pagination/ThePagination.vue'
import { debounce } from '@/utils/helper'
import { router } from '@inertiajs/vue3'

defineOptions({
    layout: TheLayout
})

interface Zone {
    id: string
    name: string
}

interface Family {
    id: string
    name: string
    start_date: Date
    file_number: number
    zone: Zone
}

interface Filters {
    perPage: number
    search: string
    page: number
    field?: string
    direction?: 'asc' | 'desc'
}

const props = defineProps<{
    families: PaginationData<Family>
    filters: Filters
    paginationMetrics: { from: number | null; total: number; to: number | null }
}>()

const filters = ref<Filters>({
    perPage: props.filters.perPage,
    search: props.filters.search,
    page: props.families.current_page
})

const setDeleteConfirmationModal = (val: boolean) => {
    console.log(val)
}

const getData = () => {
    router.get('/families', filters.value, { preserveState: true, preserveScroll: true })
}

// eslint-disable-next-line array-element-newline
watch(() => [filters.value.page, filters.value.field, filters.value.direction], getData)

watch(
    () => filters.value.perPage,
    () => {
        filters.value.page = 1

        getData()
    }
)

watch(
    () => filters.value.search,
    debounce(() => {
        filters.value.page = 1

        getData()
    }, 500)
)

const sort = (field: string) => {
    filters.value.field = field

    if (filters.value.direction === 'asc') {
        filters.value.direction = 'desc'
    } else {
        filters.value.direction = 'asc'
    }
}
</script>

<template>
    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ __('families list') }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button variant="primary" class="me-2 shadow-md"> Add New Product</base-button>
            <base-menu>
                <base-menu-button :as="BaseButton" class="!box px-2">
                    <span class="flex h-5 w-5 items-center justify-center">
                        <svg-loader name="icon-plus" class="h-4 w-4" />
                    </span>
                </base-menu-button>
                <base-menu-items class="w-40">
                    <base-menu-item>
                        <svg-loader name="icon-print" class="me-2 h-4 w-4" />
                        Print
                    </base-menu-item>
                    <base-menu-item>
                        <svg-loader name="icon-file-excel" class="me-2 h-4 w-4" />
                        Export to Excel
                    </base-menu-item>
                    <base-menu-item>
                        <svg-loader name="icon-file-pdf" class="me-2 h-4 w-4" />
                        Export to PDF
                    </base-menu-item>
                </base-menu-items>
            </base-menu>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="paginationMetrics.total > 0">
                    Showing {{ paginationMetrics.from }} to {{ paginationMetrics.to }} of
                    {{ paginationMetrics.total }} entries
                </span>
            </div>
            <div class="mt-3 w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <div class="relative w-56 text-slate-500">
                    <base-form-input
                        v-model="filters.search"
                        type="text"
                        class="!box w-56 pe-10"
                        placeholder="Search..."
                    />
                    <svg-loader name="icon-search" class="absolute inset-y-0 end-0 my-auto me-3 h-4 w-4" />
                </div>
            </div>
        </div>
    </div>

    <template v-if="families.data.length > 0">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <base-table class="mt-2 border-separate border-spacing-y-[10px]">
                <base-thead-table>
                    <base-tr-table>
                        <base-th-table class="whitespace-nowrap border-b-0 text-start"> #</base-th-table>
                        <base-th-table
                            sortable
                            :direction="filters.direction"
                            @click="sort('name')"
                            class="whitespace-nowrap border-b-0 text-start"
                        >
                            family name
                        </base-th-table>
                        <base-th-table
                            class="whitespace-nowrap border-b-0 text-center"
                            sortable
                            :direction="filters.direction"
                            @click="sort('file_number')"
                        >
                            file number
                        </base-th-table>
                        <base-th-table class="whitespace-nowrap border-b-0 text-center"> zone</base-th-table>
                        <base-th-table
                            class="whitespace-nowrap border-b-0 text-center"
                            sortable
                            :direction="filters.direction"
                            @click="sort('start_date')"
                        >
                            start data
                        </base-th-table>
                        <base-th-table class="whitespace-nowrap border-b-0 text-center"> ACTIONS</base-th-table>
                    </base-tr-table>
                </base-thead-table>
                <base-tbody-table>
                    <base-tr-table class="intro-x" v-for="(family, index) in families.data" :key="family.id">
                        <base-td-table
                            class="w-40 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ (paginationMetrics.from ?? 0) + index }}
                        </base-td-table>
                        <base-td-table
                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <a href="" class="whitespace-nowrap font-medium">
                                {{ family.name }}
                            </a>
                        </base-td-table>
                        <base-td-table
                            class="border-b-0 bg-white text-center first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ family.file_number }}
                        </base-td-table>
                        <base-td-table
                            class="border-b-0 bg-white text-center first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ family.zone }}
                        </base-td-table>
                        <base-td-table
                            class="w-40 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <div
                                :class="[
                                    'flex items-center justify-center',
                                    { 'text-success': true },
                                    { 'text-danger': false }
                                ]"
                            >
                                {{ family.start_date }}
                            </div>
                        </base-td-table>
                        <base-td-table
                            class="relative w-56 border-b-0 bg-white py-0 before:absolute before:inset-y-0 before:start-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 before:dark:bg-darkmode-400 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <div class="flex items-center justify-center">
                                <a class="me-3 flex items-center" href="#">
                                    <svg-loader name="icon-pen" class="me-1 h-4 w-4" />
                                    Edit
                                </a>
                                <a
                                    class="flex items-center text-danger"
                                    href="#"
                                    @click="
                                        (event) => {
                                            event.preventDefault()
                                            setDeleteConfirmationModal(true)
                                        }
                                    "
                                >
                                    <svg-loader name="icon-trash-can" class="me-1 h-4 w-4" />
                                    Delete
                                </a>
                            </div>
                        </base-td-table>
                    </base-tr-table>
                </base-tbody-table>
            </base-table>
        </div>

        <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
            {{ filters.page }}
            <the-pagination
                :pages="families.last_page"
                :range-size="3"
                :model-value="filters.page"
                @update:model-value="
                    (page) => {
                        filters.page = page
                    }
                "
            >
            </the-pagination>

            <base-form-select class="!box mt-3 w-20 sm:mt-0" v-model="filters.perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="35">35</option>
                <option value="50">50</option>
            </base-form-select>
        </div>
    </template>

    <div v-else class="intro-x mt-12 flex items-center justify-center">
        no data
        <svg-loader name="no-data-astro"></svg-loader>
    </div>
</template>
