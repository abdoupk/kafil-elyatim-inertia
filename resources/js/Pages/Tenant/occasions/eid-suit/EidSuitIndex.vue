<script lang="ts" setup>
import type { EidSuitOrphansResource, IndexParams, PaginationData } from '@/types/types'

import { eidSuitsFilters } from '@/constants/filters'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/eid-suit/DataTable.vue'

import BaseAlert from '@/Components/Base/Alert/BaseAlert.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { handleSort } from '@/utils/helper'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    orphans: PaginationData<EidSuitOrphansResource>
    params: IndexParams
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
        :export-pdf-url="route('tenant.occasions.eid-suit.export.pdf', params)"
        :export-xlsx-url="route('tenant.occasions.eid-suit.export.xlsx', params)"
        :filters="eidSuitsFilters"
        :pagination-data="orphans"
        :params="params"
        :title="$t('list', { attribute: $t('the_orphans_eid_suit') })"
        :url="route('tenant.occasions.eid-suit.index')"
        entries="orphans"
    >
        <template #Hints>
            <base-alert
                class="mt-5 bg-warning/20 w-1/4 dark:bg-darkmode-400 dark:border-darkmode-400"
                variant="outline-warning"
            >
                <div class="flex items-center">
                    <span>
                        <svg-loader class="w-6 h-6 me-3" name="icon-triangle-exclamation" />
                    </span>

                    <span class="text-slate-800 dark:text-slate-500"> {{ $t('placeholders.eid_suit') }} </span>
                </div>
            </base-alert>
        </template>
    </the-table-header>

    <template v-if="orphans.data.length > 0">
        <data-table :orphans :params @sort="sort($event)"></data-table>

        <the-table-footer
            :pagination-data="orphans"
            :params
            :url="route('tenant.occasions.eid-suit.index')"
        ></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>
</template>
