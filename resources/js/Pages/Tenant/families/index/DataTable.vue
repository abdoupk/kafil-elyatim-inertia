<script setup lang="ts">
import type { FamiliesIndexFilters, FamilyIndexResource, PaginationData } from '@/types/types'
import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const setDeleteConfirmationModal = (val: boolean) => {
    console.log(val)
}

defineProps<{ families: PaginationData<FamilyIndexResource>; filters: FamiliesIndexFilters }>()

const emit = defineEmits(['sort'])
</script>

<template>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <base-table class="mt-2 border-separate border-spacing-y-[10px]">
            <base-thead-table>
                <base-tr-table>
                    <base-th-table class="whitespace-nowrap border-b-0 text-start"> #</base-th-table>
                    <base-th-table
                        sortable
                        @click="emit('sort', 'name')"
                        :direction="filters.directions?.name"
                        class="whitespace-nowrap border-b-0 text-start"
                    >
                        {{ __('family') }}
                    </base-th-table>
                    <base-th-table class="whitespace-nowrap border-b-0 text-start"
                        >{{ __('validation.attributes.address') }}
                    </base-th-table>
                    <base-th-table
                        class="whitespace-nowrap border-b-0 text-center"
                        sortable
                        :direction="filters.directions?.file_number"
                        @click="emit('sort', 'file_number')"
                    >
                        {{ __('file_number') }}
                    </base-th-table>
                    <base-th-table
                        class="whitespace-nowrap border-b-0 text-center"
                        sortable
                        :direction="filters.directions?.start_date"
                        @click="emit('sort', 'start_date')"
                    >
                        {{ __('starting_sponsorship_date') }}
                    </base-th-table>
                    <base-th-table class="whitespace-nowrap border-b-0 text-center">
                        {{ __('actions') }}
                    </base-th-table>
                </base-tr-table>
            </base-thead-table>
            <base-tbody-table>
                <base-tr-table class="intro-x" v-for="(family, index) in families.data" :key="family.id">
                    <base-td-table
                        class="w-40 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                    >
                        {{ (families.meta.from ?? 0) + index }}
                    </base-td-table>
                    <base-td-table
                        class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                    >
                        <a href="" class="whitespace-nowrap font-medium">
                            {{ family.name }}
                        </a>
                    </base-td-table>
                    <base-td-table
                        class="border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                    >
                        {{ family.address }}
                        <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                            {{ family.zone }}
                        </div>
                    </base-td-table>
                    <base-td-table
                        class="border-b-0 bg-white text-center first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                    >
                        {{ family.file_number }}
                    </base-td-table>
                    <base-td-table
                        class="w-40 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                    >
                        <div
                            :class="[
                                'flex items-center justify-center',
                                { 'text-success': true },
                                { 'text-danger': false }
                            ]"
                        >
                            {{ family.start_date }}
                        </div>
                    </base-td-table>
                    <base-td-table
                        class="relative w-56 border-b-0 bg-white py-0 before:absolute before:inset-y-0 before:start-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 before:dark:bg-darkmode-400 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]"
                    >
                        <div class="flex items-center justify-center">
                            <a class="me-3 flex items-center" href="#">
                                <svg-loader name="icon-pen" class="me-1 h-4 w-4" />
                                {{ __('edit') }}
                            </a>
                            <a
                                class="flex items-center text-danger"
                                href="#"
                                @click="
                                    (event) => {
                                        event.preventDefault()
                                        setDeleteConfirmationModal(true)
                                    }
                                "
                            >
                                <svg-loader name="icon-trash-can" class="me-1 h-4 w-4" />
                                {{ __('delete') }}
                            </a>
                        </div>
                    </base-td-table>
                </base-tr-table>
            </base-tbody-table>
        </base-table>
    </div>
</template>
