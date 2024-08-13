<script lang="ts" setup>
import type { IndexParams, OrphansIndexResource, PaginationData } from '@/types/types'

import { orphansFilters } from '@/constants/filters'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/orphans/index/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import DeleteModal from '@/Components/Global/DeleteModal.vue'

import { handleSort } from '@/utils/helper'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    orphans: PaginationData<OrphansIndexResource>
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

const selectedOrphanId = ref<string>('')

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedOrphanId.value = ''

    deleteProgress.value = false
}

const deleteOrphan = () => {
    router.delete(route('tenant.orphans.destroy', selectedOrphanId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.orphans.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (orphanId: string) => {
    selectedOrphanId.value = orphanId

    deleteModalStatus.value = true
}

const sort = (field: string) => handleSort(field, params)
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_orphans') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.orphans.export.pdf', params)"
        :export-xlsx-url="route('tenant.orphans.export.xlsx', params)"
        :filters="orphansFilters"
        :pagination-data="orphans"
        :params="params"
        :title="$t('list', { attribute: $t('the_orphans') })"
        :url="route('tenant.orphans.index')"
        entries="orphans"
        exportable
        filterable
        @change-filters="params = $event"
    ></the-table-header>

    <template v-if="orphans.data.length > 0">
        <data-table :orphans :params @showDeleteModal="showDeleteModal" @sort="sort"></data-table>

        <the-table-footer :pagination-data="orphans" :params :url="route('tenant.orphans.index')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteOrphan"
    ></delete-modal>
</template>
