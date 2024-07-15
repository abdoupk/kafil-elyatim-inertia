<script lang="ts" setup>
import type { IndexParams, NeedsIndexResource, PaginationData } from '@/types/types'

import { useNeedsStore } from '@/stores/needs'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import PaginationDataTable from '@/Pages/Shared/PaginationDataTable.vue'
import NeedCreateUpdateModal from '@/Pages/Tenant/needs/NeedCreateUpdateModal.vue'
import DataTable from '@/Pages/Tenant/needs/index/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { debounce, handleSort } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineOptions({
    layout: TheLayout
})

const filterModalStatus = ref<boolean>(false)

const props = defineProps<{
    needs: PaginationData<NeedsIndexResource>
    params: IndexParams
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page,
    directions: props.params.directions,
    fields: props.params.fields
})

const search = ref(props.params.search)

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedNeedId = ref<string>('')

const updateModalStatus = ref<boolean>(false)

let routerOptions = {
    preserveState: true,
    preserveScroll: true
}

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedNeedId.value = ''

    deleteProgress.value = false
}

const processing = ref(false)

const needsStore = useNeedsStore()

const getData = () => {
    let data = { ...params }

    if (search.value !== '') {
        data.search = search.value
    }

    Object.keys(data).forEach((key) => {
        if (!data[key as keyof IndexParams]) delete data[key as keyof IndexParams]
    })

    router.get(route('tenant.needs.index'), data, {
        ...routerOptions,
        onBefore: () => {
            processing.value = true
        },
        onFinish: () => {
            processing.value = false
        }
    })
}

const sort = (field: string) => {
    handleSort(field, params)

    getData()
}

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

const showTheNeedable = ref(false)

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

watch(
    search,
    debounce(() => {
        params.page = 1

        getData()
    }, 400)
)

// eslint-disable-next-line array-element-newline
watch(() => [params.fields, params.directions, params.filters], getData)

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
    <Head :title="$t('list', { attribute: $t('the_needs') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_needs') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateModal">
                {{ n__('add new', 1, { attribute: $t('demand') }) }}
            </base-button>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="needs.meta.total > 0">
                    {{
                        $t('showing_results', {
                            from: needs.meta.from?.toString(),
                            to: needs.meta.to?.toString(),
                            total: needs.meta.total?.toString(),
                            entries: n__('needs', needs.meta.total)
                        })
                    }}
                </span>
            </div>

            <div class="mt-3 flex w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <div class="relative w-full md:w-56 text-slate-500">
                    <base-form-input
                        v-model="search"
                        :placeholder="$t('Search...')"
                        autofocus
                        class="!box w-full md:w-56 pe-10"
                        type="text"
                    />
                    <svg-loader class="absolute inset-y-0 end-0 my-auto me-3 h-4 w-4" name="icon-search" />
                </div>

                <base-button
                    class="ms-2"
                    content="Filter"
                    variant="outline-secondary"
                    @click.prevent="filterModalStatus = true"
                >
                    <svg-loader class="h-5 w-5 fill-primary" name="icon-filters"></svg-loader>
                </base-button>
            </div>
        </div>
    </div>

    <template v-if="needs.data.length > 0">
        <data-table
            :needs
            :params
            @showDeleteModal="showDeleteModal"
            @sort="sort($event)"
            @show-edit-modal="showEditModal"
        ></data-table>

        <pagination-data-table
            v-if="needs.meta.last_page > 1"
            v-model:page="params.page"
            v-model:per-page="params.perPage"
            :pages="needs.meta.last_page"
        ></pagination-data-table>
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
