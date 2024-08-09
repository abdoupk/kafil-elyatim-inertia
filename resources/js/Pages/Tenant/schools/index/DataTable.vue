<script lang="ts" setup>
import type { IndexParams, PaginationData, SchoolsIndexResource } from '@/types/types'

import { Link } from '@inertiajs/vue3'

import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { formatDate } from '@/utils/helper'

defineProps<{ schools: PaginationData<SchoolsIndexResource>; params: IndexParams }>()

// eslint-disable-next-line array-element-newline
const emit = defineEmits(['sort', 'showDeleteModal', 'showEditModal'])
</script>

<template>
    <div class="@container">
        <div class="intro-y col-span-12 hidden overflow-auto @3xl:block lg:overflow-visible">
            <base-table class="mt-2 border-separate border-spacing-y-[10px]">
                <base-thead-table>
                    <base-tr-table>
                        <base-th-table class="whitespace-nowrap border-b-0 text-start font-semibold"> #</base-th-table>

                        <base-th-table
                            :direction="params.directions?.name"
                            class="whitespace-nowrap border-b-0 text-start font-semibold"
                            sortable
                            @click="emit('sort', 'name')"
                        >
                            {{ $t('the_school') }}
                        </base-th-table>

                        <base-th-table
                            :direction="params.directions?.quota"
                            class="whitespace-nowrap border-b-0 text-center font-semibold"
                            sortable
                            @click="emit('sort', 'quota')"
                            >{{ $t('quota_total') }}
                        </base-th-table>

                        <base-th-table
                            :direction="params.directions?.created_at"
                            class="whitespace-nowrap border-b-0 text-center font-semibold"
                            sortable
                            @click="emit('sort', 'created_at')"
                        >
                            {{ $t('added_at') }}
                        </base-th-table>

                        <base-th-table class="whitespace-nowrap border-b-0 text-center font-semibold">
                            {{ $t('actions') }}
                        </base-th-table>
                    </base-tr-table>
                </base-thead-table>

                <base-tbody-table>
                    <base-tr-table v-for="(school, index) in schools.data" :key="school.id" class="intro-x">
                        <base-td-table
                            class="w-16 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ (schools.meta.from ?? 0) + index }}
                        </base-td-table>

                        <base-td-table
                            class="!min-w-40 !max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <Link :href="route('tenant.schools.show', school.id)" class="font-medium">
                                {{ school.name }}
                            </Link>
                        </base-td-table>

                        <base-td-table
                            class="max-w-40 truncate border-b-0 bg-white text-center first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ school.quota }}
                        </base-td-table>

                        <base-td-table
                            class="border-b-0 bg-white text-center first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ formatDate(school.created_at, 'full') }}
                        </base-td-table>

                        <base-td-table
                            class="relative w-56 border-b-0 bg-white py-0 before:absolute before:inset-y-0 before:start-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 before:dark:bg-darkmode-400 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <div class="flex items-center justify-center">
                                <a
                                    class="me-3 flex items-center"
                                    href="javascript:void(0)"
                                    @click.prevent="emit('showEditModal', school.id)"
                                >
                                    <svg-loader class="me-1 h-4 w-4 fill-current" name="icon-pen" />
                                    {{ $t('edit') }}
                                </a>
                                <a
                                    class="flex items-center text-danger"
                                    href="javascript:void(0)"
                                    @click="emit('showDeleteModal', school.id)"
                                >
                                    <svg-loader class="me-1 h-4 w-4 fill-current" name="icon-trash-can" />
                                    {{ $t('delete') }}
                                </a>
                            </div>
                        </base-td-table>
                    </base-tr-table>
                </base-tbody-table>
            </base-table>
        </div>

        <div class="col-span-12 my-8 grid grid-cols-12 gap-4 @3xl:hidden">
            <div v-for="school in schools.data" :key="school.id" class="intro-y col-span-12 @xl:col-span-6">
                <div class="box p-5">
                    <div class="flex">
                        <div class="me-3 truncate text-lg font-medium">
                            {{ school.name }}
                        </div>
                        <div
                            class="ms-auto flex cursor-pointer items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-500 dark:bg-darkmode-400"
                        >
                            {{ school.phone }}
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="w-3/4">
                            <p class="truncate">{{ school.email }}</p>
                            <div class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                                {{ school.zone?.name }}
                            </div>
                            <div
                                class="mt-2 flex w-fit items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-400/80 dark:bg-darkmode-400"
                            >
                                {{ school.start_date }}
                            </div>
                        </div>
                        <div class="flex w-1/4 items-center justify-end">
                            <a
                                class="me-2 font-semibold text-slate-500 dark:text-slate-400"
                                href="javascript:void(0)"
                                @click.prevent="emit('showEditModal', school.id)"
                                >{{ $t('edit') }}
                            </a>
                            <a
                                class="font-semibold text-danger"
                                href="javascript:void(0)"
                                @click="emit('showDeleteModal', school.id)"
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
