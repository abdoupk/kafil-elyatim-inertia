<script lang="ts" setup>
import type { SubjectType } from '@/types/lessons'
import type { IndexParams, PaginationData, SchoolsIndexResource } from '@/types/types'

import { schoolsFilters } from '@/constants/filters'
import { useSchoolsStore } from '@/stores/schools'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watchEffect } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import SchoolCreateModal from '@/Pages/Tenant/schools/create/SchoolCreateModal.vue'
import DataTable from '@/Pages/Tenant/schools/index/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import TheNoResultsTable from '@/Components/Global/DataTable/TheNoResultsTable.vue'
import TheTableFooter from '@/Components/Global/DataTable/TheTableFooter.vue'
import TheTableHeader from '@/Components/Global/DataTable/TheTableHeader.vue'

import { handleSort } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineOptions({
    layout: TheLayout
})

// TODO add subjects store !
const props = defineProps<{
    schools: PaginationData<SchoolsIndexResource>
    params: IndexParams
    subjects: SubjectType[]
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

const selectedSchoolId = ref<string>('')

const schoolsStore = useSchoolsStore()

const createUpdateSlideoverStatus = ref<boolean>(false)

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedSchoolId.value = ''

    deleteProgress.value = false
}

const sort = (field: string) => handleSort(field, params)

const deleteSchool = () => {
    router.delete(route('tenant.schools.destroy', selectedSchoolId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.schools.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (schoolId: string) => {
    selectedSchoolId.value = schoolId

    deleteModalStatus.value = true
}

const showCreateModal = () => {
    schoolsStore.$reset()

    createUpdateSlideoverStatus.value = true
}

const showEditModal = (schoolId: string) => {
    selectedSchoolId.value = schoolId

    schoolsStore.getSchool(schoolId)

    createUpdateSlideoverStatus.value = true
}

watchEffect(() => {
    if (new URLSearchParams(window.location.search).has('show')) {
        // TODO: show Details Modal
    }
})
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_schools') })"></Head>

    <the-table-header
        :filters="schoolsFilters"
        :pagination-data="schools"
        :params="params"
        :title="$t('list', { attribute: $t('the_schools') })"
        :url="route('tenant.schools.index')"
        entries="schools"
        export-pdf-url=""
        export-xlsx-url=""
        filterable
    >
        <template #ExtraButtons>
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                {{ n__('add new', 0, { attribute: $t('school') }) }}
            </base-button>
        </template>
    </the-table-header>

    <template v-if="schools.data.length > 0">
        <data-table
            :params
            :schools
            @showDeleteModal="showDeleteModal"
            @sort="sort"
            @show-edit-modal="showEditModal"
        ></data-table>

        <the-table-footer :pagination-data="schools" :params :url="route('tenant.schools.index')"></the-table-footer>
    </template>

    <the-no-results-table v-else></the-no-results-table>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteSchool"
    ></delete-modal>

    <school-create-modal
        :open="createUpdateSlideoverStatus"
        :subjects
        @close="createUpdateSlideoverStatus = false"
    ></school-create-modal>
</template>
