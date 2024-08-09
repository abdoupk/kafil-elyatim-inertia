<script lang="ts" setup>
import type { IndexParams, PaginationData, SchoolEntryOrphansResource } from '@/types/types'

import { schoolEntryFilters } from '@/constants/filters'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/school-entry/DataTable.vue'

import BaseAlert from '@/Components/Base/Alert/BaseAlert.vue'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { handleSort } from '@/utils/helper'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    orphans: PaginationData<SchoolEntryOrphansResource>
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
        :export-pdf-url="route('tenant.occasions.school-entry.export.pdf', params)"
        :export-xlsx-url="route('tenant.occasions.school-entry.export.xlsx', params)"
        :filters="schoolEntryFilters"
        :pagination-data="orphans"
        :params="params"
        :title="$t('list', { attribute: $t('the_families_eid_al_adha') })"
        :url="route('tenant.occasions.school-entry.index')"
        entries="orphans"
        exportable
        filterable
    >
        <template #Hints>
            <base-alert
                class="mt-5 w-1/4 bg-warning/20 dark:border-darkmode-400 dark:bg-darkmode-400"
                variant="outline-warning"
            >
                <div class="flex items-center">
                    <span>
                        <svg-loader class="me-3 h-6 w-6" name="icon-triangle-exclamation" />
                    </span>

                    <span class="text-slate-800 dark:text-slate-500"> {{ $t('hints.school_entry') }} </span>
                </div>
            </base-alert>
        </template>

        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="() => {}">
                {{ $t('save') }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="orphans.data.length > 0">
        <data-table :orphans :params @sort="sort"></data-table>

        <the-table-footer
            :pagination-data="orphans"
            :params
            :url="route('tenant.occasions.school-entry.index')"
        ></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>
</template>
