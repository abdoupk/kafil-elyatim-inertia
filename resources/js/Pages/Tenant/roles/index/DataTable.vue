<script setup lang="ts">
import { formatDate } from '@/utils/helper'

import type { IndexParams, PaginationData, RolesIndexResource } from '@/types/types'

import { Link } from '@inertiajs/vue3'

import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{ roles: PaginationData<RolesIndexResource>; params: IndexParams }>()

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
                            sortable
                            @click="emit('sort', 'name')"
                            :direction="params.directions?.name"
                            class="whitespace-nowrap border-b-0 text-start font-semibold"
                        >
                            {{ $t('the_role') }}
                        </base-th-table>

                        <base-th-table
                            sortable
                            @click="emit('sort', 'permissions_count')"
                            :direction="params.directions?.permissions_count"
                            class="whitespace-nowrap border-b-0 font-semibold text-center"
                        >
                            {{ $t('permissions_count') }}
                        </base-th-table>

                        <base-th-table
                            sortable
                            @click="emit('sort', 'users_count')"
                            :direction="params.directions?.users_count"
                            class="whitespace-nowrap border-b-0 font-semibold text-center"
                        >
                            {{ $t('users_count') }}
                        </base-th-table>

                        <base-th-table
                            sortable
                            @click="emit('sort', 'created_at')"
                            :direction="params.directions?.created_at"
                            class="whitespace-nowrap border-b-0 text-center font-semibold"
                        >
                            {{ $t('validation.attributes.created_at') }}
                        </base-th-table>

                        <base-th-table class="whitespace-nowrap border-b-0 text-center font-semibold">
                            {{ $t('actions') }}
                        </base-th-table>
                    </base-tr-table>
                </base-thead-table>

                <base-tbody-table>
                    <base-tr-table class="intro-x" v-for="(role, index) in roles.data" :key="role.id">
                        <base-td-table
                            class="w-16 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ (roles.meta.from ?? 0) + index }}
                        </base-td-table>

                        <base-td-table
                            class="!min-w-40 !max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <Link href="#" class="font-medium">
                                {{ role.name }}
                            </Link>
                        </base-td-table>

                        <base-td-table
                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"
                        >
                            {{ role.permissions_count }}
                        </base-td-table>

                        <base-td-table
                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"
                        >
                            {{ role.users_count }}
                        </base-td-table>

                        <base-td-table
                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"
                        >
                            {{ formatDate(role.created_at, 'long') }}
                        </base-td-table>

                        <base-td-table
                            class="relative w-56 border-b-0 bg-white py-0 before:absolute before:inset-y-0 before:start-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 before:dark:bg-darkmode-400 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <div class="flex items-center justify-center">
                                <a
                                    class="me-3 flex items-center"
                                    href="javascript:void(0)"
                                    @click="emit('showEditModal', role.id)"
                                >
                                    <svg-loader name="icon-pen" class="me-1 h-4 w-4 fill-current" />
                                    {{ $t('edit') }}
                                </a>
                                <a
                                    class="flex items-center text-danger"
                                    href="javascript:void(0)"
                                    @click="emit('showDeleteModal', role.id)"
                                >
                                    <svg-loader name="icon-trash-can" class="me-1 h-4 w-4 fill-current" />
                                    {{ $t('delete') }}
                                </a>
                            </div>
                        </base-td-table>
                    </base-tr-table>
                </base-tbody-table>
            </base-table>
        </div>

        <div class="col-span-12 my-8 grid grid-cols-12 gap-4 @3xl:hidden">
            <div class="intro-y col-span-12 @xl:col-span-6" v-for="role in roles.data" :key="role.id">
                <div class="box p-5">
                    <div class="flex">
                        <div class="me-3 truncate text-lg font-medium">
                            {{ role.name }}
                        </div>
                        <div
                            class="ms-auto flex cursor-pointer items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-500 dark:bg-darkmode-400"
                        >
                            {{ role.phone }}
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="w-3/4">
                            <p class="truncate">{{ role.email }}</p>
                            <div class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                                {{ role.role?.name }}
                            </div>
                            <div
                                class="mt-2 flex w-fit items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-400/80 dark:bg-darkmode-400"
                            >
                                {{ role.start_date }}
                            </div>
                        </div>
                        <div class="flex w-1/4 items-center justify-end">
                            <Link href="#" class="me-2 font-semibold text-slate-500 dark:text-slate-400"
                                >{{ $t('edit') }}
                            </Link>
                            <a
                                href="javascript:void(0)"
                                class="font-semibold text-danger"
                                @click="emit('showDeleteModal', role.uuid)"
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
