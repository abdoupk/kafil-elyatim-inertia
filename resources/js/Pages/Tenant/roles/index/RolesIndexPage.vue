<script lang="ts" setup>
import type { IndexParams, PaginationData, RolesIndexResource } from '@/types/types'

import { useRolesStore } from '@/stores/roles'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import RoleCreateEditSlideOver from '@/Pages/Tenant/roles/create/RoleCreateEditSlideOver.vue'
import DataTable from '@/Pages/Tenant/roles/index/DataTable.vue'

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
    roles: PaginationData<RolesIndexResource>
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

const createEditSlideOverStatus = ref<boolean>(false)

const rolesStore = useRolesStore()

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedRoleId = ref<string>('')

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedRoleId.value = ''

    deleteProgress.value = false
}

const sort = (field: string) => handleSort(field, params)

const deleteRole = () => {
    router.delete(route('tenant.roles.destroy', selectedRoleId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.roles.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (roleId: string) => {
    selectedRoleId.value = roleId

    deleteModalStatus.value = true
}

const showCreateModal = () => {
    rolesStore.$reset()

    createEditSlideOverStatus.value = true
}

const showEditModal = async (roleId: string) => {
    selectedRoleId.value = roleId

    await rolesStore.getRole(roleId)

    createEditSlideOverStatus.value = true
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_roles') })"></Head>

    <the-table-header
        :filters="[]"
        :pagination-data="roles"
        :params="params"
        :title="$t('list', { attribute: $t('the_roles') })"
        :url="route('tenant.roles.index')"
        entries="roles"
        export-pdf-url=""
        export-xlsx-url=""
        filterable
    >
        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                {{ n__('add new', 1, { attribute: $t('role') }) }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="roles.data.length > 0">
        <data-table
            :params
            :roles
            @showDeleteModal="showDeleteModal"
            @sort="sort"
            @show-edit-modal="showEditModal"
        ></data-table>

        <the-table-footer :pagination-data="roles" :params :url="route('tenant.roles.index')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteRole"
    ></delete-modal>

    <role-create-edit-slide-over
        :open="createEditSlideOverStatus"
        @close="createEditSlideOverStatus = false"
    ></role-create-edit-slide-over>
</template>
