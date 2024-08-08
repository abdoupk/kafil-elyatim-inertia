<script lang="ts" setup>
import type { IndexParams, NeedsIndexResource, PaginationData } from '@/types/types'

import { needsFilters } from '@/constants/filters'
import { useNeedsStore } from '@/stores/needs'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watchEffect } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import NeedCreateUpdateModal from '@/Pages/Tenant/needs/NeedCreateUpdateModal.vue'
import DataTable from '@/Pages/Tenant/needs/index/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'

import { handleSort } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    needs: PaginationData<NeedsIndexResource>
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

const selectedNeedId = ref<string>('')

const updateModalStatus = ref<boolean>(false)

const showTheNeedable = ref(false)

const needsStore = useNeedsStore()

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedNeedId.value = ''

    deleteProgress.value = false
}

const sort = (field: string) => handleSort(field, params)

const deleteNeed = () => {
    router.delete(route('tenant.needs.destroy', selectedNeedId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.needs.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (needId: string) => {
    selectedNeedId.value = needId

    deleteModalStatus.value = true
}

const showCreateModal = () => {
    updateModalStatus.value = true

    showTheNeedable.value = true
}

const showEditModal = (needId: string) => {
    selectedNeedId.value = needId

    needsStore.getNeed(needId)

    showTheNeedable.value = false

    updateModalStatus.value = true
}

watchEffect(() => {
    if (new URLSearchParams(window.location.search).has('show')) {
        // TODO: show Details Modal
    }
})
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_needs') })"></Head>

    <the-table-header
        :filters="needsFilters"
        :pagination-data="needs"
        :params="params"
        :title="$t('list', { attribute: $t('the_needs') })"
        :url="route('tenant.needs.index')"
        entries="needs"
        export-pdf-url=""
        export-xlsx-url=""
        filterable
    >
        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                {{ n__('add new', 1, { attribute: $t('demand') }) }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="needs.data.length > 0">
        <data-table
            :needs
            :params
            @showDeleteModal="showDeleteModal"
            @sort="sort"
            @show-edit-modal="showEditModal"
        ></data-table>

        <the-table-footer :pagination-data="needs" :params :url="route('tenant.needs.index')"></the-table-footer>
    </template>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteNeed"
    ></delete-modal>

    <need-create-update-modal
        :open="updateModalStatus"
        :show-the-needable="showTheNeedable"
        @close="updateModalStatus = false"
    ></need-create-update-modal>
</template>
