<script setup lang="ts">
import type { IndexFilters, PaginationData, ZonesIndexResource } from '@/types/types'

import { useZonesStore } from '@/stores/zones'
import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import PaginationDataTable from '@/Pages/Shared/PaginationDataTable.vue'
import CreateEditModal from '@/Pages/Tenant/zones/CreateEditModal.vue'
import DataTable from '@/Pages/Tenant/zones/index/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { debounce } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    zones: PaginationData<ZonesIndexResource>
    filters: IndexFilters
}>()

const filters = reactive<IndexFilters>({
    perPage: props.filters.perPage,
    page: props.filters.page,
    directions: props.filters.directions,
    fields: props.filters.fields
})

const search = ref(props.filters.search)

const deleteModalStatus = ref<boolean>(false)

const createEditModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedZoneId = ref<string>('')

let routerOptions = {
    preserveState: true,
    preserveScroll: true
}

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedZoneId.value = ''

    deleteProgress.value = false
}

const getData = () => {
    let data = { ...filters }

    if (search.value !== '') {
        data.search = search.value
    }

    Object.keys(data).forEach((key) => {
        if (!data[key as keyof IndexFilters]) delete data[key as keyof IndexFilters]
    })

    router.get(route('tenant.zones.index'), data, routerOptions)
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

const deleteZone = () => {
    router.delete(route('tenant.zones.destroy', selectedZoneId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.zones.meta.last_page < filters.page) {
                filters.page = filters.page - 1
            }

            closeDeleteModal()
        }
    })
}

const zonesStore = useZonesStore()

const showEditModal = async (zoneId: string) => {
    selectedZoneId.value = zoneId

    await zonesStore.getZone(zoneId)

    createEditModalStatus.value = true
}

const showCreateModal = () => {
    zonesStore.$reset()

    createEditModalStatus.value = true
}

const showDeleteModal = (zoneId: string) => {
    selectedZoneId.value = zoneId

    deleteModalStatus.value = true
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
    <Head :title="$t('list', { attribute: $t('the_zones') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_zones') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button variant="primary" class="me-2 shadow-md" @click.prevent="showCreateModal">
                {{ n__('add new', 0, { attribute: $t('zone') }) }}
            </base-button>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="zones.meta.total > 0">
                    {{
                        $t('showing_results', {
                            from: zones.meta.from?.toString(),
                            to: zones.meta.to?.toString(),
                            total: zones.meta.total?.toString(),
                            entries: n__('zones', zones.meta.total)
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
                        :placeholder="$t('Search...')"
                    />
                    <svg-loader name="icon-search" class="absolute inset-y-0 end-0 my-auto me-3 h-4 w-4" />
                </div>
            </div>
        </div>
    </div>

    <template v-if="zones.data.length > 0">
        <data-table
            :filters
            :zones
            @sort="sort($event)"
            @showDeleteModal="showDeleteModal"
            @show-edit-modal="showEditModal"
        ></data-table>

        <pagination-data-table
            v-if="zones.meta.last_page > 1"
            :pages="zones.meta.last_page"
            v-model:page="filters.page"
            v-model:per-page="filters.perPage"
        ></pagination-data-table>
    </template>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>

    <delete-modal
        :open="deleteModalStatus"
        :deleteProgress
        @close="closeDeleteModal"
        @delete="deleteZone"
    ></delete-modal>

    <create-edit-modal :open="createEditModalStatus" @close="createEditModalStatus = false"></create-edit-modal>
</template>
