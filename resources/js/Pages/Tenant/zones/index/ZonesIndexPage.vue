<script lang="ts" setup>
import type { IndexParams, PaginationData, ZonesIndexResource } from '@/types/types'

import { zonesFilters } from '@/constants/filters'
import { useZonesStore } from '@/stores/zones'
import { Head, router } from '@inertiajs/vue3'
import { defineAsyncComponent, reactive, ref, watchEffect } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheContentLoader from '@/Components/Global/theContentLoader.vue'

import { getDataForIndexPages, handleSort } from '@/utils/helper'
import { __, n__ } from '@/utils/i18n'

const DataTable = defineAsyncComponent(() => import('@/Pages/Tenant/zones/index/DataTable.vue'))

const BaseButton = defineAsyncComponent(() => import('@/Components/Base/button/BaseButton.vue'))

const TheNoResultsTable = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheNoResultsTable.vue'))

const TheTableFooter = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheTableFooter.vue'))

const TheTableHeader = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheTableHeader.vue'))

const DeleteModal = defineAsyncComponent(() => import('@/Components/Global/DeleteModal.vue'))

const SuccessNotification = defineAsyncComponent(() => import('@/Components/Global/SuccessNotification.vue'))

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    zones: PaginationData<ZonesIndexResource>
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

const zoneShowModal = defineAsyncComponent(() => import('@/Pages/Tenant/zones/ZoneShowModal.vue'))

const ZoneCreateEditModal = defineAsyncComponent(() => import('@/Pages/Tenant/zones/ZoneCreateEditModal.vue'))

const zonesStore = useZonesStore()

const deleteModalStatus = ref<boolean>(false)

const showSuccessNotification = ref<boolean>(false)

const createEditModalStatus = ref<boolean>(false)

const showModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedZoneId = ref<string>('')

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedZoneId.value = ''

    deleteProgress.value = false
}

const sort = (field: string) => handleSort(field, params)

const deleteZone = () => {
    router.delete(route('tenant.zones.destroy', selectedZoneId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.zones.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            getDataForIndexPages(route('tenant.zones.index'), params, {
                onStart: () => {
                    closeDeleteModal()
                },
                onFinish: () => {
                    showSuccessNotification.value = true

                    setTimeout(() => {
                        showSuccessNotification.value = false
                    }, 2000)
                },
                preserveScroll: true,
                preserveState: true
            })
        }
    })
}

const showEditModal = async (zoneId: string) => {
    selectedZoneId.value = zoneId

    await zonesStore.getZone(zoneId)

    createEditModalStatus.value = true
}

const showDetailsModal = async (zoneId: string | null) => {
    if (zoneId) {
        selectedZoneId.value = zoneId

        await zonesStore.getZoneDetails(zoneId)

        showModalStatus.value = true
    }
}

const showCreateModal = () => {
    zonesStore.$reset()

    createEditModalStatus.value = true
}

const showDeleteModal = (zoneId: string) => {
    selectedZoneId.value = zoneId

    deleteModalStatus.value = true
}

watchEffect(async () => {
    const searchParams = new URLSearchParams(window.location.search)

    if (searchParams.has('show')) {
        setTimeout(async () => {
            await showDetailsModal(searchParams.get('show'))
        }, 1000)
    }
})
</script>

<template>
    <Head :title="__('the_zones')"></Head>

    <suspense>
        <div>
            <the-table-header
                :filters="zonesFilters"
                :pagination-data="zones"
                :params="params"
                :title="__('list', { attribute: __('the_zones') })"
                :url="route('tenant.zones.index')"
                entries="zones"
                export-pdf-url=""
                export-xlsx-url=""
                filterable
                searchable
                @change-filters="params.filters = $event"
            >
                <template #ExtraButtons>
                    <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                        {{ n__('add new', 0, { attribute: __('zone') }) }}
                    </base-button>
                </template>
            </the-table-header>

            <template v-if="zones.data.length > 0">
                <data-table
                    :params
                    :zones
                    @showDeleteModal="showDeleteModal"
                    @sort="sort"
                    @show-details-modal="showDetailsModal"
                    @show-edit-modal="showEditModal"
                ></data-table>

                <the-table-footer
                    :pagination-data="zones"
                    :params
                    :url="route('tenant.zones.index')"
                ></the-table-footer>
            </template>

            <the-no-results-table v-else></the-no-results-table>

            <delete-modal
                :deleteProgress
                :open="deleteModalStatus"
                @close="closeDeleteModal"
                @delete="deleteZone"
            ></delete-modal>

            <zone-create-edit-modal
                :open="createEditModalStatus"
                @close="createEditModalStatus = false"
            ></zone-create-edit-modal>

            <zone-show-modal
                :open="showModalStatus"
                :title="__('modal_show_title', { attribute: __('the_zone') })"
                @close="showModalStatus = false"
            ></zone-show-modal>

            <success-notification
                :open="showSuccessNotification"
                :title="n__('successfully_trashed', 0, { attribute: __('the_zone') })"
            ></success-notification>
        </div>

        <template #fallback>
            <the-content-loader></the-content-loader>
        </template>
    </suspense>
</template>
