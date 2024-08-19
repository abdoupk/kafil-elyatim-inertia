<script lang="ts" setup>
import type { ArchiveOccasionType, BabiesMilkAndDiapersResource, IndexParams, PaginationData } from '@/types/types'

import { babiesMilkAndDiapersFilters } from '@/constants/filters'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/archive/details/babies-milk-and-diapers/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'

import { handleSort } from '@/utils/helper'

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
    search: props.params.search
})

const sort = (field: string) => handleSort(field, params)
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_orphans') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.archive.export.babies-milk-and-diapers.pdf', { ...params, archive: archive.id })"
        :export-xlsx-url="
            route('tenant.archive.export.babies-milk-and-diapers.xlsx', { ...params, archive: archive.id })
        "
        :filters="babiesMilkAndDiapersFilters"
        :pagination-data="orphans"
        :params="params"
        :title="$t('list', { attribute: $t('the_babies_milk_and_diapers') })"
        :url="$page.url"
        entries="orphans"
        exportable
        searchable
        @change-filters="params = $event"
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
</template>
