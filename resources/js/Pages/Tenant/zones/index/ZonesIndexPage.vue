<script lang="ts" setup>
import type { IndexParams, PaginationData, ZonesIndexResource } from '@/types/types'

import { useZonesStore } from '@/stores/zones'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watchEffect } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import ZoneCreateEditModal from '@/Pages/Tenant/zones/ZoneCreateEditModal.vue'
import DataTable from '@/Pages/Tenant/zones/index/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'

import { handleSort } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

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

const zonesStore = useZonesStore()

const deleteModalStatus = ref<boolean>(false)

const createEditModalStatus = ref<boolean>(false)

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

            closeDeleteModal()
        }
    })
}

const showEditModal = async (zoneId: string) => {
    selectedZoneId.value = zoneId

    await zonesStore.getZone(zoneId)

    createEditModalStatus.value = true
}

const showCreateModal = () => {
    zonesStore.$reset()

    createEditModalStatus.value = true
}

const showDeleteModal = (zoneId: string) => {
    selectedZoneId.value = zoneId

    deleteModalStatus.value = true
}

watchEffect(() => {
    if (new URLSearchParams(window.location.search).has('show')) {
        // TODO: show Details Modal
    }
})
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_zones') })"></Head>

    <the-table-header
        :filters="[]"
        :pagination-data="zones"
        :params="params"
        :title="$t('list', { attribute: $t('the_zones') })"
        :url="route('tenant.zones.index')"
        entries="zones"
        export-pdf-url=""
        export-xlsx-url=""
    >
        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                {{ n__('add new', 0, { attribute: $t('zone') }) }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="zones.data.length > 0">
        <data-table
            :params
            :zones
            @showDeleteModal="showDeleteModal"
            @sort="sort"
            @show-edit-modal="showEditModal"
        ></data-table>

        <the-table-footer :pagination-data="zones" :params :url="route('tenant.zones.index')"></the-table-footer>
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
</template>
