<script lang="ts" setup>
import type { IndexParams, PaginationData, RamadanBasketFamiliesResource } from '@/types/types'

import { ramadanBasketFilters } from '@/constants/filters'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/ramadan-basket/DataTable.vue'

import BaseAlert from '@/Components/Base/Alert/BaseAlert.vue'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { handleSort } from '@/utils/helper'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    families: PaginationData<RamadanBasketFamiliesResource>
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

                    <span class="text-slate-800 dark:text-slate-500"> {{ $t('hints.ramadan_basket') }} </span>
                </div>
            </base-alert>
        </template>

        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="() => {}">
                {{ $t('save') }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="families.data.length > 0">
        <data-table :families :params @sort="sort"></data-table>

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
