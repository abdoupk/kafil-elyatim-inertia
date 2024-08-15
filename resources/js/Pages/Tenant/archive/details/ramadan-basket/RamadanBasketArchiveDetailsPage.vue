<script lang="ts" setup>
import type { ArchiveOccasionType, IndexParams, PaginationData, RamadanBasketFamiliesResource } from '@/types/types'

import { ramadanBasketFilters } from '@/constants/filters'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/ramadan-basket/DataTable.vue'

import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'

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
        :export-pdf-url="route('tenant.occasions.ramadan-basket.export.pdf', params)"
        :export-xlsx-url="route('tenant.occasions.ramadan-basket.export.xlsx', params)"
        :filters="ramadanBasketFilters"
        :pagination-data="families"
        :params="params"
        :title="$t('list', { attribute: $t('the_families_ramadan_basket') })"
        :url="route('tenant.occasions.ramadan-basket.index')"
        entries="families"
        exportable
        filterable
        searchable
        @change-filters="params.filters = $event"
    >
    </the-table-header>

    <template v-if="families.data.length > 0">
        <data-table :families :params></data-table>

        <the-table-footer
            :pagination-data="families"
            :params
            :url="route('tenant.occasions.ramadan-basket.index')"
        ></the-table-footer>
    </template>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>
</template>
