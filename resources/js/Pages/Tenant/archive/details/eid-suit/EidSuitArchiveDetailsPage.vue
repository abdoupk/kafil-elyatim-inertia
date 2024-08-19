<script lang="ts" setup>
import type { ArchiveOccasionType, EidSuitOrphansResource, IndexParams, PaginationData } from '@/types/types'

import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/eid-suit/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    orphans: PaginationData<EidSuitOrphansResource>
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
    <Head :title="$t('list', { attribute: $t('the_orphans') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.archive.export.eid-suit.pdf', { ...params, archive: archive.id })"
        :export-xlsx-url="route('tenant.archive.export.eid-suit.xlsx', { ...params, archive: archive.id })"
        :filters="[]"
        :pagination-data="orphans"
        :params="params"
        :title="$t('list', { attribute: $t('the_orphans_eid_suit') })"
        :url="route('tenant.archive.details.eid-suit', archive.id)"
        entries="orphans"
        exportable
    >
    </the-table-header>

    <template v-if="orphans.data.length > 0">
        <data-table :orphans :params></data-table>

        <the-table-footer
            :pagination-data="orphans"
            :params
            :url="route('tenant.archive.details.eid-suit', archive.id)"
        ></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>
</template>
