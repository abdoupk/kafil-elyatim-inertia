<script lang="ts" setup>
import type { IndexParams, PaginationData, TrashIndexResource } from '@/types/types'

import { Head, router } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/trash/DataTable.vue'

import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import DeleteModal from '@/Components/Global/DeleteModal.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    items: PaginationData<TrashIndexResource>
    params: IndexParams
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page
})

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    deleteProgress.value = false
}

const selectedItem = ref()

const showDeleteModal = ({ id, url }: { id: string; url: string }) => {
    selectedItem.value = { id, url }

    deleteModalStatus.value = true
}

const deleteItem = () => {
    router.delete(route(selectedItem.value.url, selectedItem.value.id), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.items.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}
</script>

<template>
    <Head :title="$t('the_trash')"></Head>

    <the-table-header
        :filters="[]"
        :pagination-data="items"
        :params="params"
        :title="$t('list_trash')"
        :url="route('tenant.trash')"
        entries="items"
        export-pdf-url=""
        export-xlsx-url=""
    >
    </the-table-header>

    <template v-if="items.data.length > 0">
        <data-table :items :params @showDeleteModal="showDeleteModal"></data-table>

        <the-table-footer :pagination-data="items" :params :url="route('tenant.trash')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteItem"
    ></delete-modal>
</template>
