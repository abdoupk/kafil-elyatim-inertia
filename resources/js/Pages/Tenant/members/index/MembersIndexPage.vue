<script setup lang="ts">
import type { IndexParams, MembersIndexResource, PaginationData } from '@/types/types'

import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import PaginationDataTable from '@/Pages/Shared/PaginationDataTable.vue'
import DataTable from '@/Pages/Tenant/members/index/DataTable.vue'

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
    members: PaginationData<MembersIndexResource>
    params: IndexParams
}>()

const filters = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page,
    directions: props.params.directions,
    fields: props.params.fields,
    filters: props.params.filters
})

const search = ref(props.params.search)

const deleteModalStatus = ref<boolean>(false)

const deleteProgress = ref<boolean>(false)

const selectedMemberId = ref<string>('')

let routerOptions = {
    preserveState: true,
    preserveScroll: true
}

const closeDeleteModal = () => {
    deleteModalStatus.value = false

    selectedMemberId.value = ''

    deleteProgress.value = false
}

const getData = () => {
    let data = { ...filters }

    if (search.value !== '') {
        data.search = search.value
    }

    Object.keys(data).forEach((key) => {
        if (!data[key as keyof IndexParams]) delete data[key as keyof IndexParams]
    })

    router.get(route('tenant.members.index'), data, routerOptions)
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

const deleteMember = () => {
    router.delete(route('tenant.members.destroy', selectedMemberId.value), {
        preserveScroll: true,
        onStart: () => {
            deleteProgress.value = true
        },
        onSuccess: () => {
            if (props.members.meta.last_page < filters.page) {
                filters.page = filters.page - 1
            }

            closeDeleteModal()
        }
    })
}

const showDeleteModal = (memberId: string) => {
    selectedMemberId.value = memberId

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
    <Head :title="$t('list', { attribute: $t('the_members') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_members') }) }}
    </h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button
                variant="primary"
                class="me-2 shadow-md"
                @click.prevent="router.get(route('tenant.members.create'))"
            >
                {{ n__('add new', 1, { attribute: $t('member') }) }}
            </base-button>

            <div class="mx-auto hidden text-slate-500 md:block">
                <span v-if="members.meta.total > 0">
                    {{
                        $t('showing_results', {
                            from: members.meta.from?.toString(),
                            to: members.meta.to?.toString(),
                            total: members.meta.total?.toString(),
                            entries: n__('members', members.meta.total)
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

    <template v-if="members.data.length > 0">
        <data-table :filters :members @sort="sort($event)" @showDeleteModal="showDeleteModal"></data-table>

        <pagination-data-table
            v-if="members.meta.last_page > 1"
            :pages="members.meta.last_page"
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
        @delete="deleteMember"
    ></delete-modal>
</template>
