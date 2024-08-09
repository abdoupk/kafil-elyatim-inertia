<script lang="ts" setup>
import type { IndexParams, PaginationData, SponsorsIndexResource } from '@/types/types'

import { sponsorsFilters } from '@/constants/filters'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/sponsors/index/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import DeleteModal from '@/Components/Global/DeleteModal.vue'

import { handleSort } from '@/utils/helper'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    sponsors: PaginationData<SponsorsIndexResource>
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

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedSponsorId = ref<string>('')

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedSponsorId.value = ''

    deleteProgress.value = false
}

const sort = (field: string) => handleSort(field, params)

const deleteSponsor = () => {
    router.delete(route('tenant.sponsors.destroy', selectedSponsorId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.sponsors.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (sponsorId: string) => {
    selectedSponsorId.value = sponsorId

    deleteModalStatus.value = true
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_sponsors') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.sponsors.export.pdf', params)"
        :export-xlsx-url="route('tenant.sponsors.export.xlsx', params)"
        :filters="sponsorsFilters"
        :pagination-data="sponsors"
        :params="params"
        :title="$t('list', { attribute: $t('the_sponsors') })"
        :url="route('tenant.sponsors.index')"
        entries="sponsors"
        exportable
        filterable
    ></the-table-header>

    <template v-if="sponsors.data.length > 0">
        <data-table :params :sponsors @showDeleteModal="showDeleteModal" @sort="sort"></data-table>

        <the-table-footer :pagination-data="sponsors" :params :url="route('tenant.sponsors.index')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteSponsor"
    ></delete-modal>
</template>
