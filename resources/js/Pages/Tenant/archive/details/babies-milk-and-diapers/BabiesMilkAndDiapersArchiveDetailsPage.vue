<script lang="ts" setup>
import type { ArchiveOccasionType, BabiesMilkAndDiapersResource, IndexParams, PaginationData } from '@/types/types'

import { Head } from '@inertiajs/vue3'
import { defineAsyncComponent, reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheContentLoader from '@/Components/Global/theContentLoader.vue'

import { handleSort } from '@/utils/helper'

const DataTable = defineAsyncComponent(
    () => import('@/Pages/Tenant/archive/details/babies-milk-and-diapers/DataTable.vue')
)

const TheNoResultsTable = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheNoResultsTable.vue'))

const TheTableFooter = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheTableFooter.vue'))

const TheTableHeader = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheTableHeader.vue'))

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    orphans: PaginationData<BabiesMilkAndDiapersResource>
    params: IndexParams
    archive: ArchiveOccasionType
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page,
    directions: props.params.directions,
    fields: props.params.fields,
    filters: props.params.filters,
    search: props.params.search,
    archive: props.archive.id
})

const sort = (field: string) => handleSort(field, params)
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_orphans') })"></Head>

    <suspense>
        <div>
            <the-table-header
                :filters="[]"
                :pagination-data="orphans"
                :params="params"
                :title="$t('list', { attribute: $t('the_babies_milk_and_diapers') })"
                :url="$page.url"
                entries="orphans"
                export-pdf-url="tenant.archive.export.babies-milk-and-diapers"
                export-xlsx-url="tenant.archive.export.babies-milk-and-diapers.xlsx"
                exportable
            >
            </the-table-header>

            <template v-if="orphans.data.length > 0">
                <data-table :orphans :params @sort="sort"></data-table>

                <the-table-footer
                    :pagination-data="orphans"
                    :params
                    :url="route('tenant.occasions.babies-milk-and-diapers.index')"
                ></the-table-footer>
            </template>

            <the-no-results-table v-else></the-no-results-table>
        </div>

        <template #fallback>
            <the-content-loader></the-content-loader>
        </template>
    </suspense>
</template>
