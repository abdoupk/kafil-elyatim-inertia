<script setup lang="ts">
import type { FamiliesIndexFilters, FamilyIndexResource, PaginationData } from '@/types/types'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseMenu from '@/Components/Base/headless/Menu/BaseMenu.vue'
import BaseMenuButton from '@/Components/Base/headless/Menu/BaseMenuButton.vue'
import BaseMenuItem from '@/Components/Base/headless/Menu/BaseMenuItem.vue'
import BaseMenuItems from '@/Components/Base/headless/Menu/BaseMenuItems.vue'
import DataTable from '@/Pages/Tenant/families/index/DataTable.vue'
import DeleteFamilyModal from '@/Pages/Tenant/families/index/DeleteFamilyModal.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import PaginationDataTable from '@/Pages/Tenant/families/index/PaginationDataTable.vue'
import SpinnerLoader from '@/Components/Global/SpinnerLoader.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheLayout from '@/Layouts/TheLayout.vue'
import { TransitionRoot } from '@headlessui/vue'
import { debounce } from '@/utils/helper'
import print from 'print-js'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    families: PaginationData<FamilyIndexResource>
    filters: FamiliesIndexFilters
}>()

const filters = reactive<FamiliesIndexFilters>({
    perPage: props.filters.perPage,
    page: props.filters.page,
    directions: props.filters.directions,
    fields: props.filters.fields
})

const search = ref(props.filters.search)

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

const getData = () => {
    let data = { ...filters }

    if (search.value !== '') {
        data.search = search.value
    }

    Object.keys(data).forEach((key) => {
        if (!data[key as keyof FamiliesIndexFilters]) delete data[key as keyof FamiliesIndexFilters]
    })

    router.get(route('tenant.families.index'), data, routerOptions)
}

const sort = (field: string) => {
    filters.fields = (filters?.fields ?? []) || []

    filters.directions = { ...filters.directions }

    if (filters.fields.includes(field)) {
        const idx = filters.fields.indexOf(field)

        if (filters.directions[field] === 'asc') {
            filters.directions[field] = 'desc'
        } else {
            filters.fields.splice(idx, 1)

            delete filters.directions[field]
        }
    } else {
        filters.fields.push(field)

        filters.directions[field] = 'asc'
    }

    getData()
}

const deleteFamily = () => {
    router.delete(route('tenant.families.destroy', selectedFamilyId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.families.meta.last_page < filters.page) {
                filters.page = filters.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (familyId: string) => {
    selectedFamilyId.value = familyId

    deleteModalStatus.value = true
}

const printStarting = ref<boolean>(false)

const printPdf = () => {
    console.log()

    print({
        printable: route('tenant.families.export.pdf', filters),
        type: 'pdf',
        onLoadingStart: () => {
            printStarting.value = true
        },
        onLoadingEnd: () => {
            printStarting.value = false
        }
    })
}

watch(
    search,
    debounce(() => {
        filters.page = 1

        getData()
    }, 400)
)

watch(() => [filters.fields, filters.directions], getData)

watch(
    () => [filters.perPage],
    () => (filters.page = 1)
)

watch(
    () => [filters.page],
    () => {
        routerOptions.preserveState = false

        routerOptions.preserveScroll = false

        getData()
    }
)
</script>

<template>
    <Head :title="__('families list')"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ __('families list') }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button
                variant="primary"
                class="me-2 shadow-md"
                @click.prevent="router.get(route('tenant.families.create'))"
            >
                {{ __('add new family') }}
            </base-button>
            <base-menu>
                <base-menu-button :as="BaseButton" class="!box px-2">
                    <span class="flex h-5 w-5 items-center justify-center">
                        <svg-loader name="icon-plus" class="h-4 w-4 fill-current" />
                    </span>
                </base-menu-button>
                <base-menu-items class="w-44" placement="bottom-start">
                    <base-menu-item :disabled="printStarting" as="button" @click.prevent="printPdf"
                                    :class="{'!cursor-not-allowed opacity-80': printStarting}">
                        <svg-loader name="icon-print" class="me-2 h-4 w-4 fill-current" />
                        {{ __('print') }}
                        <transition-root class="ms-auto"
                                         :show="printStarting"
                                         enter="transition ease-out"
                                         enterFrom="scale-0"
                                         enterTo="scale-100"
                        >
                            <spinner-loader class="h-4 w-4 animate-spin "></spinner-loader>
                        </transition-root>
                    </base-menu-item>
                    <base-menu-item as="a" :href="route('tenant.families.export.xlsx', filters)">
                        <svg-loader name="icon-file-excel" class="me-2 h-4 w-4 fill-current" />
                        {{ __('export', { type: 'excel' }) }}
                    </base-menu-item>
                    <base-menu-item as="a" :href="route('tenant.families.export.pdf', filters)">
                        <svg-loader name="icon-file-pdf" class="me-2 h-4 w-4 fill-current" />
                        {{ __('export', { type: 'pdf' }) }}
                    </base-menu-item>
                </base-menu-items>
            </base-menu>
            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="families.meta.total > 0">
                    {{
                        __('showing_results', {
                            from: families.meta.from?.toString(),
                            to: families.meta.to?.toString(),
                            total: families.meta.total?.toString(),
                            entries: __('family')
                        })
                    }}
                </span>
            </div>
            <div class="mt-3 w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <div class="relative w-56 text-slate-500">
                    <base-form-input
                        autofocus
                        v-model="search"
                        type="text"
                        class="!box w-56 pe-10"
                        :placeholder="__('Search...')"
                    />
                    <svg-loader name="icon-search" class="absolute inset-y-0 end-0 my-auto me-3 h-4 w-4" />
                </div>
            </div>
        </div>
    </div>

    <template v-if="families.data.length > 0">
        <data-table :filters :families @sort="sort($event)" @showDeleteModal="showDeleteModal"></data-table>

        <pagination-data-table
            :pages="families.meta.last_page"
            v-model:page="filters.page"
            v-model:per-page="filters.perPage"
        ></pagination-data-table>
    </template>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>

    <delete-family-modal
        :open="deleteModalStatus"
        :deleteProgress
        @close="closeDeleteModal"
        @delete="deleteFamily"
    ></delete-family-modal>
</template>
