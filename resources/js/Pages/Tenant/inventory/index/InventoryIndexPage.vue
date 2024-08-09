<script lang="ts" setup>
import type { IndexParams, InventoryIndexResource, PaginationData } from '@/types/types'

import { useInventoryStore } from '@/stores/inventory'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import ItemCreateEditModal from '@/Pages/Tenant/inventory/ItemCreateEditModal.vue'
import DataTable from '@/Pages/Tenant/inventory/index/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import DeleteModal from '@/Components/Global/DeleteModal.vue'

import { handleSort } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    items: PaginationData<InventoryIndexResource>
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

const selectedItemId = ref<string>('')

const inventoryStore = useInventoryStore()

const createUpdateModalStatus = ref<boolean>(false)

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedItemId.value = ''

    deleteProgress.value = false
}

const sort = (field: string) => handleSort(field, params)

const deleteItem = () => {
    router.delete(route('tenant.inventory.destroy', selectedItemId.value), {
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

const showDeleteModal = (itemId: string) => {
    selectedItemId.value = itemId

    deleteModalStatus.value = true
}

const showCreateModal = () => {
    inventoryStore.$reset()

    createUpdateModalStatus.value = true
}

const showEditModal = (itemID: string) => {
    selectedItemId.value = itemID

    inventoryStore.getItem(itemID)

    createUpdateModalStatus.value = true
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_inventory') })"></Head>

    <the-table-header
        :filters="[]"
        :pagination-data="items"
        :params="params"
        :title="$t('the_inventory')"
        :url="route('tenant.inventory.index')"
        entries="items"
        export-pdf-url=""
        export-xlsx-url=""
        filterable
    >
        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                {{ n__('add new', 1, { attribute: $t('item') }) }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="items.data.length > 0">
        <data-table
            :items
            :params
            @showDeleteModal="showDeleteModal"
            @sort="sort"
            @show-edit-modal="showEditModal"
        ></data-table>

        <the-table-footer :pagination-data="items" :params :url="route('tenant.inventory.index')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteItem"
    ></delete-modal>

    <item-create-edit-modal
        :open="createUpdateModalStatus"
        @close="createUpdateModalStatus = false"
    ></item-create-edit-modal>
</template>
