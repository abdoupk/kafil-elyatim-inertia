<script lang="ts" setup>
import type { IndexParams, InventoryIndexResource, PaginationData } from '@/types/types'

import { useInventoryStore } from '@/stores/inventory'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watchEffect } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import ItemCreateEditModal from '@/Pages/Tenant/inventory/ItemCreateEditModal.vue'
import ItemShowModal from '@/Pages/Tenant/inventory/ItemShowModal.vue'
import DataTable from '@/Pages/Tenant/inventory/index/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import DeleteModal from '@/Components/Global/DeleteModal.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { handleSort } from '@/utils/helper'

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

const showModalStatus = ref<boolean>(false)

const showDetailsModal = async (itemId: string | null) => {
    if (itemId) {
        selectedItemId.value = itemId

        await inventoryStore.getItemDetails(itemId)

        showModalStatus.value = true
    }
}

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

const showCreateModalForBabyMilk = () => {
    inventoryStore.$reset()

    inventoryStore.item.type = 'baby_milk'

    inventoryStore.item.unit = 'piece'

    createUpdateModalStatus.value = true
}

const showCreateModalForDiapers = () => {
    inventoryStore.$reset()

    inventoryStore.item.type = 'diapers'

    inventoryStore.item.unit = 'piece'

    createUpdateModalStatus.value = true
}

const showEditModal = (itemID: string) => {
    selectedItemId.value = itemID

    inventoryStore.getItem(itemID)

    createUpdateModalStatus.value = true
}

watchEffect(async () => {
    const searchParams = new URLSearchParams(window.location.search)

    if (searchParams.has('show')) {
        await showDetailsModal(searchParams.get('show'))
    }
})
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
        searchable
        @change-filters="params.filters = $event"
    >
        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                <svg-loader name="icon-plus"></svg-loader>
            </base-button>

            <base-button class="me-2 shadow-md" variant="secondary" @click.prevent="showCreateModalForBabyMilk">
                <svg-loader name="icon-bottle-baby"></svg-loader>
            </base-button>

            <base-button class="me-2 shadow-md" variant="secondary" @click.prevent="showCreateModalForDiapers">
                <svg-loader class="stroke-current stroke-1.5" name="icon-diapers"></svg-loader>
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
            @show-details-modal="showDetailsModal"
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

    <item-show-modal
        :open="showModalStatus"
        :title="$t('modal_show_title', { attribute: $t('the_item') })"
        @close="showModalStatus = false"
    ></item-show-modal>
</template>
