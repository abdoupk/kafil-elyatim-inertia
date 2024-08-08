<script lang="ts" setup>
import type { IndexParams, ListBoxFilter, PaginationData } from '@/types/types'

import { ref, watch } from 'vue'

import ExportMenu from '@/Pages/Shared/ExportMenu.vue'
import AdvancedFilter from '@/Pages/Tenant/families/index/AdvancedFilter.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { debounce, formatFilters, getDataForIndexPages, isEmpty } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

const props = defineProps<{
    url: string
    exportPdfUrl: string
    exportXlsxUrl: string
    entries: string
    title: string
    filters: ListBoxFilter[]
    paginationData: PaginationData<unknown>
    params: IndexParams
}>()

const params = ref(props.params)

const search = ref(params.value.search)

let routerOptions = {
    preserveState: true,
    preserveScroll: true
}

const getData = () => getDataForIndexPages(props.url, params.value, routerOptions)

const handleFilterReset = () => {
    params.value.filters = []

    getData()
}

const handleFilter = (filters: IndexParams['filters']) => {
    if (!isEmpty(formatFilters(filters))) {
        params.value.filters = filters

        getData()
    }
}

watch(
    () => search.value,
    debounce(() => {
        params.value.page = 1

        params.value.search = search.value

        getData()
    }, 400)
)

watch(() => [params.value.fields, params.value.directions], getData)
</script>

<template>
    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ title }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <slot name="ExtraButtons"></slot>

            <export-menu :exportPdfUrl :exportXlsxUrl></export-menu>

            <advanced-filter
                :filters
                class="ms-2 hidden sm:block"
                placement="bottom-start"
                @update:value="handleFilter"
                @reset-filter="handleFilterReset"
            ></advanced-filter>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="paginationData.meta.total > 0">
                    {{
                        $t('showing_results', {
                            from: paginationData.meta.from?.toString(),
                            to: paginationData.meta.to?.toString(),
                            total: paginationData.meta.total?.toString(),
                            entries: n__(`entries.${entries}`, paginationData.meta.total)
                        })
                    }}
                </span>
            </div>

            <div class="mt-3 flex w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <advanced-filter
                    :filters
                    class="me-2 sm:hidden"
                    placement="bottom-start"
                    @update:value="handleFilter"
                    @reset-filter="handleFilterReset"
                ></advanced-filter>

                <div class="relative w-full md:w-56 text-slate-500">
                    <base-form-input
                        v-model="search"
                        :placeholder="$t('Search...')"
                        autofocus
                        class="!box w-full md:w-56 pe-10"
                        type="text"
                    />

                    <svg-loader class="absolute inset-y-0 end-0 my-auto me-3 h-4 w-4" name="icon-search" />
                </div>
            </div>
        </div>
    </div>
</template>
