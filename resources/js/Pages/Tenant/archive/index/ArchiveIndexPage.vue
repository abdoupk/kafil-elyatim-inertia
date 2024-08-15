<script lang="ts" setup>
import type { ArchiveIndexResource, IndexParams, PaginationData } from '@/types/types'

import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/archive/index/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    items: PaginationData<ArchiveIndexResource>
    params: IndexParams
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page
})
</script>

<template>
    <Head :title="$t('the_archive')"></Head>

    <the-table-header
        :filters="[]"
        :pagination-data="items"
        :params="params"
        :title="$t('the_archive')"
        :url="route('tenant.archive.index')"
        entries="items"
        export-pdf-url=""
        export-xlsx-url=""
        searchable
        @change-filters="params.filters = $event"
    >
    </the-table-header>

    <template v-if="items.data.length > 0">
        <data-table :items :params></data-table>

        <the-table-footer :pagination-data="items" :params :url="route('tenant.archive.index')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>
</template>
