<script lang="ts" setup>
import type { FamiliesIndexResource, IndexParams, PaginationData } from '@/types/types'

import { familiesFilters } from '@/constants/filters'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DataTable from '@/Pages/Tenant/families/index/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import DeleteModal from '@/Components/Global/DeleteModal.vue'
import SuccessNotification from '@/Components/Global/SuccessNotification.vue'

import { handleSort } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    families: PaginationData<FamiliesIndexResource>
    params: IndexParams
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page,
    directions: props.params.directions,
    fields: props.params.fields,
    search: props.params.search
})

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const showSuccessNotification = ref<boolean>(false)

const selectedFamilyId = ref<string>('')

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedFamilyId.value = ''

    deleteProgress.value = false
}

const sort = (field: string) => handleSort(field, params)

const deleteFamily = () => {
    router.delete(route('tenant.families.destroy', selectedFamilyId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.families.meta.last_page < params.page) {
                params.page = params.page - 1
            }
            
            router.get(route('tenant.families.index'), params, {
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

const showDeleteModal = (familyId: string) => {
    selectedFamilyId.value = familyId

    deleteModalStatus.value = true
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_families') })"></Head>

    <the-table-header
        :export-pdf-url="route('tenant.families.export.pdf', params)"
        :export-xlsx-url="route('tenant.families.export.xlsx', params)"
        :filters="familiesFilters"
        :pagination-data="families"
        :params="params"
        :title="$t('list', { attribute: $t('the_families') })"
        :url="route('tenant.families.index')"
        entries="families"
        exportable
        filterable
        searchable
        @change-filters="params = $event"
    >
        <template #ExtraButtons>
            <base-button
                class="me-2 shadow-md"
                variant="primary"
                @click.prevent="router.get(route('tenant.families.create'))"
            >
                {{ n__('add new', 0, { attribute: $t('family') }) }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="families.data.length > 0">
        <data-table :families :params @showDeleteModal="showDeleteModal" @sort="sort"></data-table>

        <the-table-footer :pagination-data="families" :params :url="route('tenant.families.index')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteFamily"
    ></delete-modal>

    <success-notification
        :open="showSuccessNotification"
        :title="n__('successfully_trashed', 0, { attribute: $t('the_family') })"
    ></success-notification>
</template>
