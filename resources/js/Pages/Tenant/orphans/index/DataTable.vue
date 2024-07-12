<script lang="ts" setup>
import type { IndexParams, OrphansIndexResource, PaginationData } from '@/types/types'

import { Link } from '@inertiajs/vue3'

import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { formatDate } from '@/utils/helper'

defineProps<{ orphans: PaginationData<OrphansIndexResource>; params: IndexParams }>()

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
                            {{ $t('the_child') }}
                        </base-th-table>

                        <base-th-table
                            :direction="params.directions?.family_status"
                            class="whitespace-nowrap border-b-0 text-center font-semibold"
                            sortable
                            @click="emit('sort', 'email')"
                        >
                            {{ $t('family_status') }}
                        </base-th-table>

                        <base-th-table
                            :direction="params.directions?.health_status"
                            class="whitespace-nowrap border-b-0 font-semibold text-center"
                            sortable
                            @click="emit('sort', 'health_status')"
                            >{{ $t('validation.attributes.sponsor.health_status') }}
                        </base-th-table>

                        <base-th-table
                            :direction="params.directions?.academic_level"
                            class="whitespace-nowrap border-b-0 font-semibold text-center"
                            sortable
                            @click="emit('sort', 'academic_level')"
                            >{{ $t('validation.attributes.sponsor.academic_level') }}
                        </base-th-table>

                        <!--                        <base-th-table-->
                        <!--                            :direction="params.directions?.shoes_size"-->
                        <!--                            class="whitespace-nowrap border-b-0 font-semibold text-center"-->
                        <!--                            sortable-->
                        <!--                            @click="emit('sort', 'shoes_size')"-->
                        <!--                            >{{ $t('shoes_size') }}-->
                        <!--                        </base-th-table>-->

                        <!--                        <base-th-table-->
                        <!--                            :direction="params.directions?.pants_size"-->
                        <!--                            class="whitespace-nowrap border-b-0 font-semibold text-center"-->
                        <!--                            sortable-->
                        <!--                            @click="emit('sort', 'pants_size')"-->
                        <!--                            >{{ $t('pants_size') }}-->
                        <!--                        </base-th-table>-->

                        <!--                        <base-th-table-->
                        <!--                            :direction="params.directions?.shirt_size"-->
                        <!--                            class="whitespace-nowrap border-b-0 font-semibold text-center"-->
                        <!--                            sortable-->
                        <!--                            @click="emit('sort', 'shirt_size')"-->
                        <!--                            >{{ $t('shirt_size') }}-->
                        <!--                        </base-th-table>-->

                        <base-th-table
                            :direction="params.directions?.birth_date"
                            class="whitespace-nowrap border-b-0 font-semibold text-center"
                            sortable
                            @click="emit('sort', 'birth_date')"
                            >{{ $t('validation.attributes.date_of_birth') }}
                        </base-th-table>

                        <base-th-table class="whitespace-nowrap border-b-0 text-center font-semibold">
                            {{ $t('actions') }}
                        </base-th-table>
                    </base-tr-table>
                </base-thead-table>

                <base-tbody-table>
                    <base-tr-table v-for="(orphan, index) in orphans.data" :key="orphan.id" class="intro-x">
                        <base-td-table
                            class="w-16 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ (orphans.meta.from ?? 0) + index }}
                        </base-td-table>

                        <base-td-table
                            class="!min-w-40 !max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <Link :href="route('tenant.orphans.show', orphan.id)" class="font-medium">
                                {{ orphan.name }}
                            </Link>
                        </base-td-table>

                        <base-td-table
                            class="max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ orphan.family_status }}
                        </base-td-table>

                        <base-td-table
                            class="max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"
                        >
                            {{ orphan.health_status }}
                        </base-td-table>

                        <base-td-table
                            class="border-b-0 max-w-40 truncate bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"
                        >
                            {{ orphan.academic_level }}
                        </base-td-table>

                        <!--                        <base-td-table-->
                        <!--                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"-->
                        <!--                        >-->
                        <!--                            {{ orphan.shoes_size }}-->
                        <!--                        </base-td-table>-->

                        <!--                        <base-td-table-->
                        <!--                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"-->
                        <!--                        >-->
                        <!--                            {{ orphan.pants_size }}-->
                        <!--                        </base-td-table>-->

                        <!--                        <base-td-table-->
                        <!--                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"-->
                        <!--                        >-->
                        <!--                            {{ orphan.shirt_size }}-->
                        <!--                        </base-td-table>-->

                        <base-td-table
                            class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b] text-center"
                        >
                            {{ formatDate(orphan.birth_date, 'long') }}
                        </base-td-table>

                        <base-td-table
                            class="relative w-56 border-b-0 bg-white py-0 before:absolute before:inset-y-0 before:start-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 before:dark:bg-darkmode-400 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <div class="flex items-center justify-center">
                                <a
                                    class="me-3 flex items-center"
                                    href="javascript:void(0)"
                                    @click.prevent="emit('showEditModal', orphan.id)"
                                >
                                    <svg-loader class="me-1 h-4 w-4 fill-current" name="icon-pen" />
                                    {{ $t('edit') }}
                                </a>
                                <a
                                    class="flex items-center text-danger"
                                    href="javascript:void(0)"
                                    @click="emit('showDeleteModal', orphan.id)"
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
            <div v-for="orphan in orphans.data" :key="orphan.id" class="intro-y col-span-12 @xl:col-span-6">
                <div class="box p-5">
                    <div class="flex">
                        <div class="me-3 truncate text-lg font-medium">
                            {{ orphan.name }}
                        </div>
                        <div
                            class="ms-auto flex cursor-pointer items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-500 dark:bg-darkmode-400"
                        >
                            {{ orphan.phone }}
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="w-3/4">
                            <p class="truncate">{{ orphan.email }}</p>
                            <div class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                                {{ orphan.zone?.name }}
                            </div>
                            <div
                                class="mt-2 flex w-fit items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-400/80 dark:bg-darkmode-400"
                            >
                                {{ orphan.start_date }}
                            </div>
                        </div>
                        <div class="flex w-1/4 items-center justify-end">
                            <a
                                class="me-2 font-semibold text-slate-500 dark:text-slate-400"
                                href="javascript:void(0)"
                                @click.prevent="emit('showEditModal', orphan.id)"
                                >{{ $t('edit') }}
                            </a>
                            <a
                                class="font-semibold text-danger"
                                href="javascript:void(0)"
                                @click="emit('showDeleteModal', orphan.id)"
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
