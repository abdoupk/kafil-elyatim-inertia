<script lang="ts" setup>
/* eslint-disable */
import type { ArchiveOccasionType, IndexParams, PaginationData, RamadanBasketFamiliesResource } from '@/types/types'

import { ramadanBasketFilters } from '@/constants/filters'
import { useSettingsStore } from '@/stores/settings'
import { Head } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/ramadan-basket/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import TheOccasionHint from '@/Components/Global/TheOccasionHint.vue'
import TheWarningModal from '@/Components/Global/TheWarningModal.vue'

import { getDataForIndexPages, handleSort } from '@/utils/helper'

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

const exportable = ref(false)

const loading = ref(false)

const showWarningModalStatus = ref(false)

const sort = (field: string) => handleSort(field, params)

const save = () => {
    getDataForIndexPages(route('tenant.occasions.ramadan-basket.save-to-archive'), params, {
        onStart: () => {
            loading.value = true
        },
        onSuccess: () => {
            loading.value = false

            showWarningModalStatus.value = false

            setTimeout(() => {
                exportable.value = true
            }, 500)
        },
        preserveScroll: true,
        preserveState: true,
        only: ['families']
    })
}
const handleSave = () => {
    if (props.archive?.created_at) {
        showWarningModalStatus.value = true
    }
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
            <the-occasion-hint
                :on-hidden="
                    () => {
                        useSettingsStore().setHintToHidden('ramadan_basket')
                    }
                "
                hint-type="ramadan_basket"
            ></the-occasion-hint>
        </template>

        <template #ExtraButtons>
            <base-button :disabled="loading" class="me-2 shadow-md" variant="primary" @click.prevent="handleSave">
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

    <the-warning-modal
        :on-progress="loading"
        :open="showWarningModalStatus"
        @accept="save"
        @close="showWarningModalStatus = false"
    ></the-warning-modal>
</template>
