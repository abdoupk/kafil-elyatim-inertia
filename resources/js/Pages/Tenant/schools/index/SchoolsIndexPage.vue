<script lang="ts" setup>
import type { SubjectType } from '@/types/lessons'
import type { IndexParams, PaginationData, SchoolsIndexResource } from '@/types/types'

import { useSchoolsStore } from '@/stores/schools'
import { Head, router } from '@inertiajs/vue3'
import { defineAsyncComponent, reactive, ref, watchEffect } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheContentLoader from '@/Components/Global/theContentLoader.vue'

import { getDataForIndexPages, handleSort } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

const SchoolShowModal = defineAsyncComponent(() => import('@/Pages/Tenant/schools/SchoolShowModal.vue'))

const SchoolCreateModal = defineAsyncComponent(() => import('@/Pages/Tenant/schools/create/SchoolCreateModal.vue'))

const DataTable = defineAsyncComponent(() => import('@/Pages/Tenant/schools/index/DataTable.vue'))

const BaseButton = defineAsyncComponent(() => import('@/Components/Base/button/BaseButton.vue'))

const TheNoResultsTable = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheNoResultsTable.vue'))

const TheTableFooter = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheTableFooter.vue'))

const TheTableHeader = defineAsyncComponent(() => import('@/Components/Global/DataTable/TheTableHeader.vue'))

const DeleteModal = defineAsyncComponent(() => import('@/Components/Global/DeleteModal.vue'))

const SuccessNotification = defineAsyncComponent(() => import('@/Components/Global/SuccessNotification.vue'))

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

const showSuccessNotification = ref<boolean>(false)

const selectedSchoolId = ref<string>('')

const schoolsStore = useSchoolsStore()

const createUpdateSlideoverStatus = ref<boolean>(false)

const showModalStatus = ref<boolean>(false)

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

            getDataForIndexPages(route('tenant.schools.index'), params, {
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

const showDetailsModal = async (schoolId: string | null) => {
    if (schoolId) {
        selectedSchoolId.value = schoolId

        await schoolsStore.getSchoolDetails(schoolId)

        showModalStatus.value = true
    }
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
    <Head :title="$t('the_schools')"></Head>

    <suspense>
        <div>
            <the-table-header
                :filters="[]"
                :pagination-data="schools"
                :params="params"
                :title="$t('list', { attribute: $t('the_schools') })"
                :url="route('tenant.schools.index')"
                entries="schools"
                export-pdf-url=""
                export-xlsx-url=""
                searchable
                @change-filters="params.filters = $event"
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
                    @show-details-modal="showDetailsModal"
                ></data-table>

                <the-table-footer
                    :pagination-data="schools"
                    :params
                    :url="route('tenant.schools.index')"
                ></the-table-footer>
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

            <school-show-modal
                :open="showModalStatus"
                :title="$t('modal_show_title', { attribute: $t('the_school') })"
                @close="showModalStatus = false"
            ></school-show-modal>

            <success-notification
                :open="showSuccessNotification"
                :title="n__('successfully_trashed', 0, { attribute: $t('the_school') })"
            ></success-notification>
        </div>

        <template #fallback>
            <the-content-loader></the-content-loader>
        </template>
    </suspense>
</template>
