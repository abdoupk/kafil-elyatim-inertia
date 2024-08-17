<script lang="ts" setup>
import type { ArchiveOccasionType, EidAlAdhaFamiliesResource, IndexParams, PaginationData } from '@/types/types'

import { eidAlAdhaFilters } from '@/constants/filters'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/eid-al-adha/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    families: PaginationData<EidAlAdhaFamiliesResource>
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
    <!--    TODO change title in all heads-->
    <Head :title="$t('list', { attribute: $t('the_families') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.archive.export.eid-al-adha.pdf', { ...params, archive: archive.id })"
        :export-xlsx-url="route('tenant.archive.export.eid-al-adha.xlsx', { ...params, archive: archive.id })"
        :filters="eidAlAdhaFilters"
        :pagination-data="families"
        :params="params"
        :title="$t('list', { attribute: $t('the_families_eid_al_adha') })"
        :url="route('tenant.occasions.eid-al-adha.index')"
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
            :url="route('tenant.occasions.eid-al-adha.index')"
        ></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>
</template>
