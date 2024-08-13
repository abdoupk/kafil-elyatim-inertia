<script lang="ts" setup>
import type { ArchiveOccasionType, IndexParams, PaginationData, SchoolEntryOrphansResource } from '@/types/types'

import { schoolEntryFilters } from '@/constants/filters'
import { useSettingsStore } from '@/stores/settings'
import { Head } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/occasions/school-entry/DataTable.vue'

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
    search: props.params.search
})

const exportable = ref(false)

const loading = ref(false)

const showWarningModalStatus = ref(false)

const sort = (field: string) => handleSort(field, params)

const save = () => {
    getDataForIndexPages(route('tenant.occasions.school-entry.save-to-archive'), params, {
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
        only: ['orphans']
    })
}

const handleSave = () => {
    if (props.archive?.created_at) showWarningModalStatus.value = true
    else save()
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_orphans') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.occasions.school-entry.export.pdf', params)"
        :export-xlsx-url="route('tenant.occasions.school-entry.export.xlsx', params)"
        :exportable
        :filters="schoolEntryFilters"
        :pagination-data="orphans"
        :params="params"
        :title="$t('list', { attribute: $t('the_families_eid_al_adha') })"
        :url="route('tenant.occasions.school-entry.index')"
        entries="orphans"
        filterable
        @change-filters="params = $event"
    >
        <template #Hints>
            <the-occasion-hint
                :on-hidden="
                    () => {
                        useSettingsStore().setHintToHidden('school_entry')
                    }
                "
                hint-type="school_entry"
            ></the-occasion-hint>
        </template>

        <template #ExtraButtons>
            <base-button :disabled="loading" class="me-2 shadow-md" variant="primary" @click.prevent="handleSave">
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

    <the-warning-modal
        :on-progress="loading"
        :open="showWarningModalStatus"
        @accept="save"
        @close="showWarningModalStatus = false"
    ></the-warning-modal>
</template>
