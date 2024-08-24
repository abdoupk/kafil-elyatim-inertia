<script lang="ts" setup>
import type { ArchiveOccasionType, EidAlAdhaFamiliesResource, IndexParams, PaginationData } from '@/types/types'

import { Head } from '@inertiajs/vue3'
import { defineAsyncComponent, reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheContentLoader from '@/Components/Global/theContentLoader.vue'

const DataTable = defineAsyncComponent(() => import('@/Pages/Tenant/occasions/eid-al-adha/DataTable.vue'))

const TheNoResultsTable = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheNoResultsTable.vue'))

const TheTableFooter = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheTableFooter.vue'))

const TheTableHeader = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheTableHeader.vue'))

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
    search: props.params.search,
    archive: props.archive.id
})
</script>

<template>
    <!--    TODO change title in all heads-->
    <Head :title="$t('list', { attribute: $t('the_families') })"></Head>

    <suspense>
        <div>
            <the-table-header
                :filters="[]"
                :pagination-data="families"
                :params="params"
                :title="$t('list', { attribute: $t('the_families_eid_al_adha') })"
                :url="route('tenant.occasions.eid-al-adha.index')"
                entries="families"
                export-pdf-url="tenant.archive.export.eid-al-adha.pdf"
                export-xlsx-url="tenant.archive.export.eid-al-adha.xlsx"
                exportable
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
        </div>

        <template #fallback>
            <the-content-loader></the-content-loader>
        </template>
    </suspense>
</template>
