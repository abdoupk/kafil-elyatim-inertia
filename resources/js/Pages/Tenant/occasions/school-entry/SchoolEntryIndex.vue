<script lang="ts" setup>
import type { IndexParams, PaginationData, SchoolEntryOrphansResource } from '@/types/types'

import { Head, router } from '@inertiajs/vue3'
import { reactive, ref, watch } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import PaginationDataTable from '@/Pages/Shared/PaginationDataTable.vue'
import DataTable from '@/Pages/Tenant/occasions/school-entry/DataTable.vue'
import ExportMenu from '@/Pages/Shared/ExportMenu.vue'

import BaseAlert from '@/Components/Base/Alert/BaseAlert.vue'
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
    orphans: PaginationData<SchoolEntryOrphansResource>
    params: IndexParams
}>()

const params = reactive<IndexParams>({
    perPage: props.params.perPage,
    page: props.params.page,
    directions: props.params.directions,
    fields: props.params.fields
})

const search = ref(props.params.search)

let routerOptions = {
    preserveState: true,
    preserveScroll: true
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

    router.get(route('tenant.occasions.school-entry.index'), data, {
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
    <Head :title="$t('list', { attribute: $t('the_orphans') })"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">
        {{ $t('list', { attribute: $t('the_orphans') }) }}
    </h2>

    <base-alert
        class="mt-5 bg-warning/20 w-1/4 dark:bg-darkmode-400 dark:border-darkmode-400"
        variant="outline-warning"
    >
        <div class="flex items-center">
            <span>
                <svg-loader class="w-6 h-6 me-3" name="icon-triangle-exclamation" />
            </span>
            <span class="text-slate-800 dark:text-slate-500"> تم فلترة النتائج لعرض فقط الاسر .... </span>
        </div>
    </base-alert>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button class="me-2 shadow-md" variant="primary" @click.prevent="() => {}">
                {{ $t('save') }}
            </base-button>

            <export-menu :params
                         export-pdf-url="tenant.occasions.school-entry.export.pdf" export-xlsx-url="tenant.occasions.school-entry.export.xlsx"></export-menu>

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

    <template v-if="orphans.data.length > 0">
        <data-table :orphans :params @sort="sort($event)"></data-table>

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
</template>
