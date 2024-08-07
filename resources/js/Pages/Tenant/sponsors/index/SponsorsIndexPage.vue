<script lang="ts" setup>
import type { IndexParams, ListBoxFilter, ListBoxOperator, PaginationData, SponsorsIndexResource } from '@/types/types'

import { sponsorsFilters } from '@/constants/filters'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import ExportMenu from '@/Pages/Shared/ExportMenu.vue'
import PaginationDataTable from '@/Pages/Shared/PaginationDataTable.vue'
import AdvancedFilter from '@/Pages/Tenant/families/index/AdvancedFilter.vue'
import DataTable from '@/Pages/Tenant/sponsors/index/DataTable.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { debounce, handleFilterValue, handleSort, shouldFetchFilterData } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    sponsors: PaginationData<SponsorsIndexResource>
    params: IndexParams
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page,
    directions: props.params.directions,
    fields: props.params.fields,
    filters: props.params.filters
})

const search = ref(props.params.search)

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedSponsorId = ref<string>('')

let routerOptions = {
    preserveState: true,
    preserveScroll: true
}

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedSponsorId.value = ''

    deleteProgress.value = false
}

const getData = () => {
    let data = { ...params }

    if (search.value !== '') {
        data.search = search.value
    }

    Object.keys(data).forEach((key) => {
        if (!data[key as keyof IndexParams]) delete data[key as keyof IndexParams]
    })

    router.get(route('tenant.sponsors.index'), data, routerOptions)
}

const sort = (field: string) => {
    handleSort(field, params)

    getData()
}

const deleteSponsor = () => {
    router.delete(route('tenant.sponsors.destroy', selectedSponsorId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.sponsors.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (sponsorId: string) => {
    selectedSponsorId.value = sponsorId

    deleteModalStatus.value = true
}

const handleFilterName = (field: ListBoxFilter, value: object | string): string => {
    if (field.field === 'sponsorships') {
        return `${field.field}.${value.value}`
    }

    return field.field
}

const handleFilter = (filters: { field: ListBoxFilter; operator: ListBoxOperator; value: string }[]) => {
    // @ts-ignore
    params.filters = {
        ...filters
            ?.map((filter) => {
                return {
                    field: handleFilterName(filter.field, filter.value),
                    operator: filter?.operator?.value,
                    value: handleFilterValue(filter.field, filter.value)
                }
            })
            .filter((filter) => filter.value !== '')
    }
}

watch(
    () => [params.filters],
    (value, oldValue) => {
        if (shouldFetchFilterData(value, oldValue)) getData()
    }
)

watch(
    search,
    debounce(() => {
        params.page = 1

        getData()
    }, 400)
)

watch(() => [params.fields, params.directions], getData)

watch(
    () => [params.perPage],
    () => (params.page = 1)
)

watch(
    () => [params.page],
    () => {
        routerOptions.preserveState = false

        routerOptions.preserveScroll = false

        getData()
    }
)
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_sponsors') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_sponsors') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <export-menu
                :export-pdf-url="route('tenant.sponsors.export.pdf', params)"
                :export-xlsx-url="route('tenant.sponsors.export.xlsx', params)"
            ></export-menu>

            <advanced-filter
                :filters="sponsorsFilters"
                class="ms-2 hidden sm:block"
                placement="bottom-start"
                @update:value="handleFilter"
            ></advanced-filter>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="sponsors.meta.total > 0">
                    {{
                        $t('showing_results', {
                            from: sponsors.meta.from?.toString(),
                            to: sponsors.meta.to?.toString(),
                            total: sponsors.meta.total?.toString(),
                            entries: n__('entries.sponsors', sponsors.meta.total)
                        })
                    }}
                </span>
            </div>

            <div class="mt-3 flex w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <advanced-filter
                    :filters="sponsorsFilters"
                    class="me-2 sm:hidden"
                    placement="bottom-start"
                    @update:value="handleFilter"
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

    <template v-if="sponsors.data.length > 0">
        <data-table :params :sponsors @showDeleteModal="showDeleteModal" @sort="sort($event)"></data-table>

        <pagination-data-table
            v-model:page="params.page"
            v-model:per-page="params.perPage"
            :pages="sponsors.meta.last_page"
        ></pagination-data-table>
    </template>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteSponsor"
    ></delete-modal>
</template>
