<script setup lang="ts">
import type { FamiliesIndexResource, IndexParams, PaginationData } from '@/types/types'

import { Link } from '@inertiajs/vue3'

import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import { formatDate } from '../../../../utils/helper'

defineProps<{ families: PaginationData<FamiliesIndexResource>; params: IndexParams }>()

const emit = defineEmits(['sort', 'showDeleteModal'])
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
                            {{ $t('the_family') }}
                        </base-th-table>
                        <base-th-table class="whitespace-nowrap border-b-0 text-start font-semibold"
                            >{{ $t('validation.attributes.address') }}
                        </base-th-table>
                        <base-th-table
                            class="whitespace-nowrap border-b-0 text-center font-semibold"
                            sortable
                            :direction="params.directions?.file_number"
                            @click="emit('sort', 'file_number')"
                        >
                            {{ $t('file_number') }}
                        </base-th-table>
                        <base-th-table
                            class="whitespace-nowrap border-b-0 text-start font-semibold"
                            sortable
                            :direction="params.directions?.start_date"
                            @click="emit('sort', 'start_date')"
                        >
                            {{ $t('validation.attributes.starting_sponsorship_date') }}
                        </base-th-table>
                        <base-th-table class="whitespace-nowrap border-b-0 text-center font-semibold">
                            {{ $t('actions') }}
                        </base-th-table>
                    </base-tr-table>
                </base-thead-table>
                <base-tbody-table>
                    <base-tr-table class="intro-x" v-for="(family, index) in families.data" :key="family.id">
                        <base-td-table
                            class="w-16 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ (families.meta.from ?? 0) + index }}
                        </base-td-table>
                        <base-td-table
                            class="!min-w-40 !max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <Link :href="route('tenant.families.show', family.id)" class="font-medium">
                                {{ family.name }}
                            </Link>
                        </base-td-table>
                        <base-td-table
                            class="max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ family.address }}
                            <!--  TODO: change href to route('tenant.zones.show', family.zone.id)-->
                            <Link href="#" class="mt-0.5 block whitespace-nowrap text-xs text-slate-500">
                                {{ family.zone?.name }}
                            </Link>
                        </base-td-table>
                        <base-td-table
                            class="border-b-0 bg-white text-center first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            {{ family.file_number }}
                        </base-td-table>
                        <base-td-table
                            class="w-40 text-start border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <div class="whitespace-nowrap">
                                {{ formatDate(family.start_date, 'long') }}
                            </div>
                        </base-td-table>
                        <base-td-table
                            class="relative w-56 border-b-0 bg-white py-0 before:absolute before:inset-y-0 before:start-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 before:dark:bg-darkmode-400 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                        >
                            <div class="flex items-center justify-center">
                                <Link class="me-3 flex items-center" :href="route('tenant.families.edit', family.id)">
                                    <svg-loader name="icon-pen" class="me-1 h-4 w-4 fill-current" />
                                    {{ $t('edit') }}
                                </Link>
                                <a
                                    class="flex items-center text-danger"
                                    href="javascript:void(0)"
                                    @click="emit('showDeleteModal', family.id)"
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
            <div class="intro-y col-span-12 @xl:col-span-6" v-for="family in families.data" :key="family.id">
                <div class="box p-5">
                    <div class="flex">
                        <div class="me-3 truncate text-lg font-medium">
                            {{ family.name }}
                        </div>
                        <div
                            class="ms-auto flex cursor-pointer items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-500 dark:bg-darkmode-400"
                        >
                            {{ family.file_number }}
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="w-3/4">
                            <p class="truncate">{{ family.address }}</p>
                            <div class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                                {{ family.zone?.name }}
                            </div>
                            <div
                                class="mt-2 flex w-fit items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-400/80 dark:bg-darkmode-400"
                            >
                                {{ family.start_date }}
                            </div>
                        </div>
                        <div class="flex w-1/4 items-center justify-end">
                            <Link
                                :href="route('tenant.families.show', family.id)"
                                class="me-2 font-semibold text-slate-500 dark:text-slate-400"
                                >{{ $t('edit') }}
                            </Link>
                            <a
                                href="javascript:void(0)"
                                class="font-semibold text-danger"
                                @click="emit('showDeleteModal', family.id)"
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
