<script lang="ts" setup>
import type { BranchesIndexResource, IndexParams, PaginationData } from '@/types/types'

import { Link } from '@inertiajs/vue3'

import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import TheTableTd from '@/Components/Global/DataTable/TheTableTd.vue'
import TheTableTdActions from '@/Components/Global/DataTable/TheTableTdActions.vue'
import TheTableTh from '@/Components/Global/DataTable/TheTableTh.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { formatDate } from '@/utils/helper'

defineProps<{ branches: PaginationData<BranchesIndexResource>; params: IndexParams }>()

// eslint-disable-next-line array-element-newline
const emit = defineEmits(['sort', 'showDeleteModal', 'showEditModal', 'showDetailsModal'])
</script>

<template>
    <div v-if="branches.data.length > 0" class="@container">
        <div class="intro-y col-span-12 hidden overflow-auto @4xl:block lg:overflow-visible">
            <base-table class="mt-2 border-separate border-spacing-y-[10px]">
                <base-thead-table>
                    <base-tr-table>
                        <the-table-th class="text-start"> #</the-table-th>

                        <the-table-th
                            :direction="params.directions?.name"
                            class="text-start"
                            sortable
                            @click="emit('sort', 'name')"
                        >
                            {{ $t('the_branch') }}
                        </the-table-th>

                        <the-table-th
                            :direction="params.directions?.email"
                            class="text-start"
                            sortable
                            @click="emit('sort', 'email')"
                        >
                            {{ $t('branch_president') }}
                        </the-table-th>

                        <the-table-th class="text-center">{{ $t('location') }}</the-table-th>

                        <the-table-th class="text-center">
                            {{ $t('families_count') }}
                        </the-table-th>

                        <the-table-th
                            :direction="params.directions?.start_date"
                            class="text-center"
                            sortable
                            @click="emit('sort', 'start_date')"
                        >
                            {{ $t('validation.attributes.created_at') }}
                        </the-table-th>

                        <the-table-th class="text-center">
                            {{ $t('actions') }}
                        </the-table-th>
                    </base-tr-table>
                </base-thead-table>

                <base-tbody-table>
                    <base-tr-table v-for="(branch, index) in branches.data" :key="branch.id" class="intro-x">
                        <the-table-td class="w-16">
                            {{ (branches.meta.from ?? 0) + index }}
                        </the-table-td>

                        <the-table-td class="!min-w-40 !max-w-40 truncate">
                            <a class="font-medium" href="#" @click.prevent="emit('showDetailsModal', branch.id)">
                                {{ branch.name }}
                            </a>
                        </the-table-td>

                        <the-table-td class="max-w-40 truncate">
                            <Link :href="route('tenant.families.index', branch.president?.id)" class="font-medium">
                                {{ branch.president?.name }}
                            </Link>
                        </the-table-td>

                        <the-table-td class="!min-w-40 !max-w-40 truncate text-center">
                            {{ branch.city }}
                        </the-table-td>

                        <the-table-td>
                            <div class="whitespace-nowrap text-center">
                                {{ branch.families_count }}
                            </div>
                        </the-table-td>

                        <the-table-td>
                            <div class="whitespace-nowrap text-center">
                                {{ formatDate(branch.created_at) }}
                            </div>
                        </the-table-td>

                        <the-table-td-actions>
                            <div class="flex items-center justify-center">
                                <a
                                    class="me-3 flex items-center"
                                    href="#"
                                    @click.prevent="emit('showEditModal', branch.id)"
                                >
                                    <svg-loader class="me-1 h-4 w-4 fill-current" name="icon-pen" />
                                    {{ $t('edit') }}
                                </a>
                                <a
                                    class="flex items-center text-danger"
                                    href="javascript:void(0)"
                                    @click="emit('showDeleteModal', branch.id)"
                                >
                                    <svg-loader class="me-1 h-4 w-4 fill-current" name="icon-trash-can" />
                                    {{ $t('delete') }}
                                </a>
                            </div>
                        </the-table-td-actions>
                    </base-tr-table>
                </base-tbody-table>
            </base-table>
        </div>

        <div class="col-span-12 my-8 grid grid-cols-12 gap-4 @4xl:hidden">
            <div v-for="branch in branches.data" :key="branch.id" class="intro-y col-span-12 @xl:col-span-6">
                <div class="box p-5">
                    <div class="flex">
                        <div class="me-3 truncate text-lg font-medium">
                            {{ branch.name }}
                        </div>
                        <div
                            class="ms-auto flex cursor-pointer items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-500 dark:bg-darkmode-400"
                        >
                            {{ branch.phone }}
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="w-3/4">
                            <p class="truncate">{{ branch.email }}</p>
                            <div class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                                {{ branch.zone?.name }}
                            </div>
                            <div
                                class="mt-2 flex w-fit items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-400/80 dark:bg-darkmode-400"
                            >
                                {{ branch.start_date }}
                            </div>
                        </div>
                        <div class="flex w-1/4 items-center justify-end">
                            <a
                                class="me-2 font-semibold text-slate-500 dark:text-slate-400"
                                href="#"
                                @click.prevent="emit('showEditModal', branch.id)"
                                >{{ $t('edit') }}
                            </a>
                            <a
                                class="font-semibold text-danger"
                                href="javascript:void(0)"
                                @click="emit('showDeleteModal', branch.id)"
                            >
                                {{ $t('delete') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
        <no-results-found></no-results-found>
    </div>
</template>
