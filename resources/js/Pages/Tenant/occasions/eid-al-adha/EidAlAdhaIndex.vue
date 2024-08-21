<script lang="ts" setup>
import type { ArchiveOccasionType, EidAlAdhaFamiliesResource, IndexParams, PaginationData } from '@/types/types'

import { eidAlAdhaFilters } from '@/constants/filters'
import { useSettingsStore } from '@/stores/settings'
import { Head } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/eid-al-adha/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import TheOccasionHint from '@/Components/Global/TheOccasionHint.vue'
import TheWarningModal from '@/Components/Global/TheWarningModal.vue'

import { getDataForIndexPages, handleSort } from '@/utils/helper'

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

const exportable = ref(false)

const loading = ref(false)

const showWarningModalStatus = ref(false)

const sort = (field: string) => handleSort(field, params)

const save = () => {
    getDataForIndexPages(route('tenant.occasions.eid-al-adha.save-to-archive'), params, {
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
    if (props.archive?.created_at) showWarningModalStatus.value = true
    else save()
}
</script>

<template>
    <!--    TODO change title in all heads-->
    <Head :title="$t('the_families_eid_al_adha')"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.occasions.eid-al-adha.export.pdf', params)"
        :export-xlsx-url="route('tenant.occasions.eid-al-adha.export.xlsx', params)"
        :exportable
        :filters="eidAlAdhaFilters"
        :pagination-data="families"
        :params="params"
        :title="$t('list', { attribute: $t('the_families_eid_al_adha') })"
        :url="route('tenant.occasions.eid-al-adha.index')"
        entries="families"
        filterable
        searchable
        @change-filters="params.filters = $event"
    >
        <template #Hints>
            <the-occasion-hint
                :on-hidden="
                    () => {
                        useSettingsStore().setHintToHidden('eid_al_adha')
                    }
                "
                hint-type="eid_al_adha"
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
            :url="route('tenant.occasions.eid-al-adha.index')"
        ></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <the-warning-modal
        :on-progress="loading"
        :open="showWarningModalStatus"
        @accept="save"
        @close="showWarningModalStatus = false"
    ></the-warning-modal>
</template>
