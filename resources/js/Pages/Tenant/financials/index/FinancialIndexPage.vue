<script lang="ts" setup>
import type { FinancialTransactionsIndexResource, IndexParams, PaginationData } from '@/types/types'

import { useFinancialTransactionsStore } from '@/stores/financial-transactions'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import PaginationDataTable from '@/Pages/Shared/PaginationDataTable.vue'
import FinancialTransactionCreateModal from '@/Pages/Tenant/financials/create/FinancialTransactionCreateModal.vue'
import DataTable from '@/Pages/Tenant/financials/index/DataTable.vue'

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
    finances: PaginationData<FinancialTransactionsIndexResource>
    params: IndexParams
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page,
    directions: props.params.directions,
    fields: props.params.fields
})

const search = ref(props.params.search)

const financialTransactionsStore = useFinancialTransactionsStore()

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedFinancialTransactionId = ref<string>('')

const createEditModalStatus = ref<boolean>(false)

let routerOptions = {
    preserveState: true,
    preserveScroll: true
}

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedFinancialTransactionId.value = ''

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

    router.get(route('tenant.financial.index'), data, {
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

const deleteFinancialTransaction = () => {
    router.delete(route('tenant.financial.destroy', selectedFinancialTransactionId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.finances.meta.last_page < params.page) {
                params.page = params.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (financeId: string) => {
    selectedFinancialTransactionId.value = financeId

    deleteModalStatus.value = true
}

const showCreateIncomeModal = () => {
    financialTransactionsStore.$reset()

    createEditModalStatus.value = true
}

const showCreateExpenseModal = () => {
    financialTransactionsStore.$reset()

    financialTransactionsStore.financialTransaction.type = 'expense'

    createEditModalStatus.value = true
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
    <Head :title="$t('list', { attribute: $t('the_finances') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_finances') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="showCreateIncomeModal">
                {{ n__('add new', 1, { attribute: $t('income') }) }}
            </base-button>

            <base-button class="me-2 shadow-md" variant="outline-danger" @click.prevent="showCreateExpenseModal">
                {{ n__('add new', 1, { attribute: $t('expense') }) }}
            </base-button>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="finances.meta.total > 0">
                    {{
                        $t('showing_results', {
                            from: finances.meta.from?.toString(),
                            to: finances.meta.to?.toString(),
                            total: finances.meta.total?.toString(),
                            entries: n__('entries.finances', finances.meta.total)
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

    <template v-if="finances.data.length > 0">
        <data-table :finances :params @showDeleteModal="showDeleteModal" @sort="sort"></data-table>

        <pagination-data-table
            v-model:page="params.page"
            v-model:per-page="params.perPage"
            :pages="finances.meta.last_page"
        ></pagination-data-table>
    </template>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="closeDeleteModal"
        @delete="deleteFinancialTransaction"
    ></delete-modal>

    <financial-transaction-create-modal
        :open="createEditModalStatus"
        @close="createEditModalStatus = false"
    ></financial-transaction-create-modal>
</template>
