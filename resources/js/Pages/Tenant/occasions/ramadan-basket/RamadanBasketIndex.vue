<script lang="ts" setup>
/* eslint-disable */
import type { IndexParams, PaginationData, RamadanBasketFamiliesResource } from '@/types/types'

import { ramadanBasketFilters } from '@/constants/filters'
import { Head } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/ramadan-basket/DataTable.vue'

import BaseAlert from '@/Components/Base/Alert/BaseAlert.vue'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SpinnerButtonLoader from '@/Components/Global/SpinnerButtonLoader.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { getDataForIndexPages, handleSort } from '@/utils/helper'

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

const exportable = ref(false)

const loading = ref(false)

const sort = (field: string) => handleSort(field, params)

const handleSave = () => {
    // router.get(route('tenant.occasions.ramadan-basket.save-to-archive'), formatFilters(params.filters), {
    //     onStart: () => {
    //         loading.value = true
    //     },
    //     onSuccess: () => {
    //         exportable.value = true
    //
    //         loading.value = false
    //     },
    //     preserveScroll: true,
    //     preserveState: true
    // })
    console.log(params.filters)
    getDataForIndexPages(route('tenant.occasions.ramadan-basket.save-to-archive'), params, {
        onStart: () => {
            loading.value = true
        },
        onSuccess: () => {
            exportable.value = true

            loading.value = false
        },
        preserveScroll: true,
        preserveState: true
    })
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_families') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.occasions.ramadan-basket.export.pdf', params)"
        :export-xlsx-url="route('tenant.occasions.ramadan-basket.export.xlsx', params)"
        :exportable
        :filters="ramadanBasketFilters"
        :pagination-data="families"
        :params="params"
        :title="$t('list', { attribute: $t('the_families_ramadan_basket') })"
        :url="route('tenant.occasions.ramadan-basket.index')"
        entries="families"
        filterable
        @change-filters="params.filters = $event"
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

                    <span class="text-slate-800 dark:text-slate-500"> {{ $t('hints.ramadan_basket') }} </span>
                </div>
            </base-alert>
        </template>

        <template #ExtraButtons>
            <base-button :disabled="loading" class="me-2 shadow-md" variant="primary" @click.prevent="handleSave">
                {{ $t('save') }}

                <spinner-button-loader :show="loading" class="ms-2"></spinner-button-loader>
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
