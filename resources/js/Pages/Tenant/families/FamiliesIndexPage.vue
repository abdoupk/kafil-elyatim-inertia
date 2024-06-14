<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3'
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
    address: string
}

interface Filters {
    perPage: number
    search: string
    page: number
    fields?: string[]
    directions?: {
        [key: string]: 'asc' | 'desc'
    }
}

const props = defineProps<{
    families: PaginationData<Family>
    filters: Filters
}>()

const filters = ref<Filters>({
    perPage: props.filters.perPage,
    search: props.filters.search,
    page: props.filters.page,
    directions: { name: 'desc' },
    fields: props.filters.fields
})

const setDeleteConfirmationModal = (val: boolean) => {
    console.log(val)
}

const getData = () => {
    router.get(route('tenant.families.index'), filters.value, { preserveState: true, preserveScroll: true })
}

const sort = (field: string) => {
    filters.value.fields = filters.value?.fields ? [...filters.value?.fields] : []

    filters.value.directions = { ...filters.value.directions }

    if (filters.value.fields.includes(field)) {
        const idx = filters.value.fields.indexOf(field)

        if (filters.value.directions[field] === 'asc') {
            filters.value.directions[field] = 'desc'
        } else {
            filters.value.fields.splice(idx, 1)

            delete filters.value.directions[field]
        }
    } else {
        filters.value.fields.push(field)

        filters.value.directions[field] = 'asc'
    }

    getData()
}

// eslint-disable-next-line array-element-newline
watch(() => [filters.value.page, filters.value.fields, filters.value.directions], getData)

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
</script>

<template>
    <Head :title="__('families list')"></Head>
    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ __('families list') }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button
                variant="primary"
                class="me-2 shadow-md"
                @click.prevent="router.get(route('tenant.families.create'))"
            >
                {{ __('create new family') }}
            </base-button>
            <base-menu>
                <base-menu-button :as="BaseButton" class="!box px-2">
                    <span class="flex h-5 w-5 items-center justify-center">
                        <svg-loader name="icon-plus" class="h-4 w-4" />
                    </span>
                </base-menu-button>
                <base-menu-items class="w-40">
                    <base-menu-item>
                        <svg-loader name="icon-print" class="me-2 h-4 w-4" />
                        {{ __('print') }}
                    </base-menu-item>
                    <base-menu-item>
                        <svg-loader name="icon-file-excel" class="me-2 h-4 w-4" />
                        {{ __('export to excel') }}
                    </base-menu-item>
                    <base-menu-item>
                        <svg-loader name="icon-file-pdf" class="me-2 h-4 w-4" />
                        {{ __('export to pdf') }}
                    </base-menu-item>
                </base-menu-items>
            </base-menu>
            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="families.meta.total > 0">
                    {{
                        __('showing_results', {
                            from: families.meta.from.toString(),
                            to: families.meta.to.toString(),
                            total: families.meta.total.toString()
                        })
                    }}
                </span>
            </div>
            <div class="mt-3 w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <div class="relative w-56 text-slate-500">
                    <base-form-input
                        autofocus
                        v-model="filters.search"
                        type="text"
                        class="!box w-56 pe-10"
                        :placeholder="__('Search...')"
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
                            @click="sort('name')"
                            :direction="filters.directions?.name"
                            class="whitespace-nowrap border-b-0 text-start"
                        >
                            {{ __('family') }}
                        </base-th-table>
                        <base-th-table class="whitespace-nowrap border-b-0 text-start">{{
                            __('validation.attributes.address')
                        }}</base-th-table>
                        <base-th-table
                            class="whitespace-nowrap border-b-0 text-center"
                            sortable
                            :direction="filters.directions?.file_number"
                            @click="sort('file_number')"
                        >
                            {{ __('file_number') }}
                        </base-th-table>
                        <base-th-table
                            class="whitespace-nowrap border-b-0 text-center"
                            sortable
                            :direction="filters.directions?.start_date"
                            @click="sort('start_date')"
                        >
                            {{ __('starting_sponsorship_date') }}
                        </base-th-table>
                        <base-th-table class="whitespace-nowrap border-b-0 text-center">
                            {{ __('actions') }}</base-th-table
                        >
                    </base-tr-table>
                </base-thead-table>
                <base-tbody-table>
                    <base-tr-table class="intro-x" v-for="(family, index) in families.data" :key="family.id">
                        <base-td-table
                            class="w-40 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ (families.meta.from ?? 0) + index }}
                        </base-td-table>
                        <base-td-table
                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <a href="" class="whitespace-nowrap font-medium">
                                {{ family.name }}
                            </a>
                        </base-td-table>
                        <base-td-table
                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ family.address }}
                            <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                                {{ family.zone }}
                            </div>
                        </base-td-table>
                        <base-td-table
                            class="border-b-0 bg-white text-center first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ family.file_number }}
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
                                    {{ __('edit') }}
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
                                    {{ __('delete') }}
                                </a>
                            </div>
                        </base-td-table>
                    </base-tr-table>
                </base-tbody-table>
            </base-table>
        </div>

        <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
            <the-pagination
                :pages="families.meta.last_page"
                :range-size="3"
                :model-value="filters.page"
                @update:model-value="filters.page = $event"
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
