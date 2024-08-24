<script lang="ts" setup>
import type { ArchiveOccasionType, IndexParams, PaginationData, SchoolEntryOrphansResource } from '@/types/types'

import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/school-entry/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    orphans: PaginationData<SchoolEntryOrphansResource>
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
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_orphans') })"></Head>

    <the-table-header
        :filters="[]"
        :pagination-data="orphans"
        :params="params"
        :title="$t('list', { attribute: $t('the_families_eid_al_adha') })"
        :url="route('tenant.occasions.school-entry.index')"
        entries="orphans"
        export-pdf-url="tenant.archive.export.school-entry.pdf"
        export-xlsx-url="tenant.archive.export.school-entry.xlsx"
        exportable
    >
    </the-table-header>

    <template v-if="orphans.data.length > 0">
        <data-table :orphans :params></data-table>

        <the-table-footer
            :pagination-data="orphans"
            :params
            :url="route('tenant.occasions.school-entry.index')"
        ></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>
</template>
