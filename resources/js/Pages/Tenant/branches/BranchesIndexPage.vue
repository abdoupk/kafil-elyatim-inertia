<script lang="ts" setup>
import type { BranchesIndexResource, IndexParams, PaginationData } from '@/types/types'

import { useBranchesStore } from '@/stores/branches'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watchEffect } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import BranchCreateEditModal from '@/Pages/Tenant/branches/BranchCreateEditModal.vue'
import BranchShowModal from '@/Pages/Tenant/branches/BranchShowModal.vue'
import DataTable from '@/Pages/Tenant/branches/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import DeleteModal from '@/Components/Global/DeleteModal.vue'

import { handleSort } from '@/utils/helper'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    branches: PaginationData<BranchesIndexResource>
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

const createEditModalStatus = ref<boolean>(false)

const showModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedBranchId = ref<string>('')

const branchesStore = useBranchesStore()

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedBranchId.value = ''

    deleteProgress.value = false
}

const sort = (field: string) => handleSort(field, params)

const deleteBranch = () => {
    router.delete(route('tenant.branches.destroy', selectedBranchId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.branches.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (branchId: string) => {
    selectedBranchId.value = branchId

    deleteModalStatus.value = true
}

const showCreateModal = () => {
    branchesStore.$reset()

    createEditModalStatus.value = true
}

const showEditModal = async (branchId: string) => {
    selectedBranchId.value = branchId

    await branchesStore.getBranch(branchId)

    createEditModalStatus.value = true
}

const showDetailsModal = async (branchID: string | null) => {
    if (branchID) {
        selectedBranchId.value = branchID

        await branchesStore.getBranchDetails(branchID)

        showModalStatus.value = true
    }
}

watchEffect(async () => {
    const searchParams = new URLSearchParams(window.location.search)

    if (searchParams.has('show')) {
        await showDetailsModal(searchParams.get('show'))
    }
})
</script>

<template>
    <Head :title="$t('list', { attribute: $t('branches') })"></Head>

    <the-table-header
        :filters="[]"
        :pagination-data="branches"
        :params="params"
        :title="$t('list', { attribute: $t('branches') })"
        :url="route('tenant.branches.index')"
        entries="branches"
        export-pdf-url=""
        export-xlsx-url=""
        searchable
        @change-filters="params = $event"
    >
        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                {{ n__('add new', 1, { attribute: $t('branch') }) }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="branches.data.length > 0">
        <data-table
            :branches
            :params
            @showDeleteModal="showDeleteModal"
            @sort="sort"
            @show-edit-modal="showEditModal"
            @show-details-modal="showDetailsModal"
        ></data-table>

        <the-table-footer :pagination-data="branches" :params :url="route('tenant.branches.index')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteBranch"
    ></delete-modal>

    <branch-create-edit-modal
        :open="createEditModalStatus"
        @close="createEditModalStatus = false"
    ></branch-create-edit-modal>

    <branch-show-modal
        :open="showModalStatus"
        :title="$t('modal_show_title', { attribute: $t('the_branch') })"
        @close="showModalStatus = false"
    ></branch-show-modal>
</template>
