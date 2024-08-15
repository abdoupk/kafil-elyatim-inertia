<script lang="ts" setup>
import type { ArchiveIndexResource, IndexParams, PaginationData } from '@/types/types'

import { Link } from '@inertiajs/vue3'

import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import TheTableTd from '@/Components/Global/DataTable/TheTableTd.vue'
import TheTableTh from '@/Components/Global/DataTable/TheTableTh.vue'

import { formatDate } from '@/utils/helper'

defineProps<{ items: PaginationData<ArchiveIndexResource>; params: IndexParams }>()

const emit = defineEmits(['showDeleteModal', 'restore'])
</script>

<template>
    <div class="@container">
        <div class="intro-y col-span-12 hidden overflow-auto @3xl:block lg:overflow-visible">
            <base-table class="mt-2 border-separate border-spacing-y-[10px]">
                <base-thead-table>
                    <base-tr-table>
                        <the-table-th class="text-start"> #</the-table-th>

                        <the-table-th class="text-start">
                            {{ $t('the_item') }}
                        </the-table-th>

                        <the-table-th class="text-center">
                            {{ $t('archive.saved_by') }}
                        </the-table-th>

                        <the-table-th class="text-center">{{ $t('validation.attributes.created_at') }}</the-table-th>

                        <the-table-th class="text-center">
                            {{ $t('archive.families_count') }}
                        </the-table-th>
                    </base-tr-table>
                </base-thead-table>

                <base-tbody-table>
                    <base-tr-table v-for="(item, index) in items.data" :key="item.id" class="intro-x">
                        <the-table-td class="w-16">
                            {{ (items.meta.from ?? 0) + index }}
                        </the-table-td>

                        <the-table-td class="!min-w-44 !max-w-44 truncate">
                            <Link :href="item.url" class="font-medium">
                                {{ item.name }}
                            </Link>
                        </the-table-td>

                        <the-table-td class="max-w-40 truncate">
                            {{ item.savedBy.name }}
                        </the-table-td>

                        <the-table-td class="text-center">
                            {{ formatDate(item.created_at, 'long') }}
                        </the-table-td>

                        <the-table-td class="w-40">
                            {{ item.families_count }}
                        </the-table-td>
                    </base-tr-table>
                </base-tbody-table>
            </base-table>
        </div>

        <div class="col-span-12 my-8 grid grid-cols-12 gap-4 @3xl:hidden">
            <div v-for="item in items.data" :key="item.id" class="intro-y col-span-12 @xl:col-span-6">
                <div class="box p-5">
                    <div class="flex">
                        <div class="me-3 truncate text-lg font-medium">
                            {{ item.name }}
                        </div>
                        <div
                            class="ms-auto flex cursor-pointer items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-500 dark:bg-darkmode-400"
                        >
                            {{ formatDate(item.deleted_at, 'full') }}
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="w-3/4">
                            <p class="truncate">{{ item.user_name }}</p>
                        </div>
                        <div class="flex w-1/4 items-center justify-end">
                            <a
                                class="me-2 font-semibold text-slate-500 dark:text-slate-400"
                                href="javascript:void(0)"
                                @click.prevent="emit('restore', item.id)"
                                >{{ $t('edit') }}
                            </a>
                            <a
                                class="font-semibold text-danger"
                                href="javascript:void(0)"
                                @click="emit('showDeleteModal', item.id)"
                            >
                                {{ $t('delete') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
