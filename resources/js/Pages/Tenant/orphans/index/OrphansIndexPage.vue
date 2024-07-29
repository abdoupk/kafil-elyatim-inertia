<script lang="ts" setup>
import type { IndexParams, OrphansIndexResource, PaginationData } from '@/types/types'

import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import PaginationDataTable from '@/Pages/Shared/PaginationDataTable.vue'
import DataTable from '@/Pages/Tenant/orphans/index/DataTable.vue'
import ExportMenu from '@/Pages/Tenant/orphans/index/ExportMenu.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { debounce, handleSort } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    orphans: PaginationData<OrphansIndexResource>
    params: IndexParams
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page,
    directions: props.params.directions,
    fields: props.params.fields,
    filters: props.params.filters
})

const search = ref(props.params.search)

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedOrphanId = ref<string>('')

let routerOptions = {
    preserveState: true,
    preserveScroll: true
}

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedOrphanId.value = ''

    deleteProgress.value = false
}

const getData = () => {
    let data = { ...params }

    if (search.value !== '') {
        data.search = search.value
    }

    Object.keys(data).forEach((key) => {
        if (!data[key as keyof IndexParams]) delete data[key as keyof IndexParams]
    })

    router.get(route('tenant.orphans.index'), data, routerOptions)
}

const sort = (field: string) => {
    handleSort(field, params)

    getData()
}

const deleteOrphan = () => {
    router.delete(route('tenant.orphans.destroy', selectedOrphanId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.orphans.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (orphanId: string) => {
    selectedOrphanId.value = orphanId

    deleteModalStatus.value = true
}

watch(
    search,
    debounce(() => {
        params.page = 1

        getData()
    }, 400)
)

watch(() => [params.fields, params.directions], getData)

watch(
    () => [params.perPage],
    () => (params.page = 1)
)

watch(
    () => [params.page],
    () => {
        routerOptions.preserveState = false

        routerOptions.preserveScroll = false

        getData()
    }
)
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_orphans') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_orphans') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <export-menu :params></export-menu>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="orphans.meta.total > 0">
                    {{
                        $t('showing_results', {
                            from: orphans.meta.from?.toString(),
                            to: orphans.meta.to?.toString(),
                            total: orphans.meta.total?.toString(),
                            entries: n__('entries.orphans', orphans.meta.total)
                        })
                    }}
                </span>
            </div>

            <div class="mt-3 w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <div class="relative w-56 text-slate-500">
                    <base-form-input
                        v-model="search"
                        :placeholder="$t('Search...')"
                        autofocus
                        class="!box w-56 pe-10"
                        type="text"
                    />
                    <svg-loader class="absolute inset-y-0 end-0 my-auto me-3 h-4 w-4" name="icon-search" />
                </div>
            </div>
        </div>
    </div>

    <template v-if="orphans.data.length > 0">
        <data-table :orphans :params @showDeleteModal="showDeleteModal" @sort="sort($event)"></data-table>

        <pagination-data-table
            v-if="orphans.meta.last_page > 1"
            v-model:page="params.page"
            v-model:per-page="params.perPage"
            :pages="orphans.meta.last_page"
        ></pagination-data-table>
    </template>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteOrphan"
    ></delete-modal>
</template>
