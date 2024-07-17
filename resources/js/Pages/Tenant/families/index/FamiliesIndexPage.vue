<script lang="ts" setup>
import type { FamiliesIndexResource, IndexParams, ListBoxFilter, PaginationData } from '@/types/types'

import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import FilterModal from '@/Pages/Shared/FilterModal.vue'
import PaginationDataTable from '@/Pages/Shared/PaginationDataTable.vue'
import AdvancedFilter from '@/Pages/Tenant/families/index/AdvancedFilter.vue'
import DataTable from '@/Pages/Tenant/families/index/DataTable.vue'
import ExportMenu from '@/Pages/Tenant/families/index/ExportMenu.vue'

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
    families: PaginationData<FamiliesIndexResource>
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

const selectedFamilyId = ref<string>('')

let routerOptions = {
    preserveState: true,
    preserveScroll: true
}

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedFamilyId.value = ''

    deleteProgress.value = false
}

const processing = ref(false)

const getData = () => {
    let data = { ...params }

    if (search.value !== '') {
        data.search = search.value
    }

    Object.keys(data).forEach((key) => {
        if (!data[key as keyof IndexParams]) delete data[key as keyof IndexParams]
    })

    router.get(route('tenant.families.index'), data, {
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

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (familyId: string) => {
    selectedFamilyId.value = familyId

    deleteModalStatus.value = true
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

const filters = ref<ListBoxFilter[]>([
    {
        icon: 'icon-users',
        field: 'name',
        operators: [
            {
                label: 'is',
                value: '='
            },
            {
                label: 'is not',
                value: '!='
            }
        ]
    },
    {
        icon: 'icon-calendar',
        field: 'age',
        operators: [
            {
                label: 'equals',
                value: '='
            },
            {
                label: 'is greater than',
                value: '>'
            },
            {
                label: 'is less than',
                value: '<'
            },
            {
                label: 'is greater than or equal to',
                value: '>='
            },
            {
                label: 'is less than or equal to',
                value: '<='
            }
        ]
    }
])

const handleFilter = (filters: IndexParams['filters']) => {
    params.filters = {
        ...filters
            ?.map((filter) => {
                return {
                    field: filter.field.field,
                    operator: filter.operator.value,
                    value: filter.value
                }
            })
            .filter((filter) => filter.value !== '')
    }
}
</script>

<template>
    <Head :title="$t('list', { attribute: $t('the_families') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_families') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button
                class="me-2 shadow-md"
                variant="primary"
                @click.prevent="router.get(route('tenant.families.create'))"
            >
                {{ n__('add new', 0, { attribute: $t('family') }) }}
            </base-button>

            <export-menu :params class="block sm:hidden"></export-menu>

            <advanced-filter :filters class="hidden sm:block" @update:value="handleFilter"></advanced-filter>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="families.meta.total > 0">
                    {{
                        $t('showing_results', {
                            from: families.meta.from?.toString(),
                            to: families.meta.to?.toString(),
                            total: families.meta.total?.toString(),
                            entries: n__('families', families.meta.total)
                        })
                    }}
                </span>
            </div>

            <div class="mt-3 flex w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <export-menu :params class="hidden sm:block sm:me-2"></export-menu>

                <advanced-filter :filters class="me-2 sm:hidden"></advanced-filter>

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
            </div>
        </div>
    </div>

    <template v-if="families.data.length > 0">
        <data-table :families :params @showDeleteModal="showDeleteModal" @sort="sort($event)"></data-table>

        <pagination-data-table
            v-if="families.meta.last_page > 1"
            v-model:page="params.page"
            v-model:per-page="params.perPage"
            :pages="families.meta.last_page"
        ></pagination-data-table>
    </template>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteFamily"
    ></delete-modal>

    <filter-modal
        :open="filterModalStatus"
        :processing
        @close="filterModalStatus = false"
        @filter="(args) => (params.filters = { ...args })"
    ></filter-modal>
</template>
