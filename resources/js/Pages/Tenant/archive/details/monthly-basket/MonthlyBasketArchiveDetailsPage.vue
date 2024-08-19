<script lang="ts" setup>
import type { ArchiveOccasionType, IndexParams, PaginationData, RamadanBasketFamiliesResource } from '@/types/types'

import { monthlyBasketFilters } from '@/constants/filters'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/monthly-basket/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    families: PaginationData<RamadanBasketFamiliesResource>
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
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_families') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.archive.export.monthly-basket.pdf', { ...params, archive: archive.id })"
        :export-xlsx-url="route('tenant.archive.export.monthly-basket.xlsx', { ...params, archive: archive.id })"
        :filters="monthlyBasketFilters"
        :pagination-data="families"
        :params="params"
        :title="$t('list', { attribute: $t('the_families_monthly_basket') })"
        :url="route('tenant.occasions.monthly-basket.index')"
        entries="families"
        exportable
        filterable
        searchable
        @change-filters="params = $event"
    >
    </the-table-header>

    <template v-if="families.data.length > 0">
        <data-table :families :params></data-table>

        <the-table-footer
            :pagination-data="families"
            :params
            :url="route('tenant.occasions.monthly-basket.index')"
        ></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>
</template>
