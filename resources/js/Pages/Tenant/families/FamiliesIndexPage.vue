<script setup lang="ts">
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseMenu from '@/Components/Base/headless/Menu/BaseMenu.vue'
import BaseMenuButton from '@/Components/Base/headless/Menu/BaseMenuButton.vue'
import BaseMenuItem from '@/Components/Base/headless/Menu/BaseMenuItem.vue'
import BaseMenuItems from '@/Components/Base/headless/Menu/BaseMenuItems.vue'
import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheLayout from '@/Layouts/TheLayout.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{ families: object }>()

const setDeleteConfirmationModal = (val: boolean) => {
    console.log(val)
}
</script>

<template>
    <h2 class="intro-y mt-10 text-lg font-medium">{{ __('families list') }}</h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <base-button variant="primary" class="me-2 shadow-md"> Add New Product</base-button>
            <base-menu>
                <base-menu-button :as="BaseButton" class="!box px-2">
                    <span class="flex h-5 w-5 items-center justify-center">
                        <svg-loader name="icon-plus" class="h-4 w-4" />
                    </span>
                </base-menu-button>
                <base-menu-items class="w-40">
                    <base-menu-item>
                        <svg-loader name="icon-print" class="me-2 h-4 w-4" />
                        Print
                    </base-menu-item>
                    <base-menu-item>
                        <svg-loader name="icon-file-excel" class="me-2 h-4 w-4" />
                        Export to Excel
                    </base-menu-item>
                    <base-menu-item>
                        <svg-loader name="icon-file-pdf" class="me-2 h-4 w-4" />
                        Export to PDF
                    </base-menu-item>
                </base-menu-items>
            </base-menu>

            <div class="mx-auto hidden text-slate-500 md:block">Showing 1 to 10 of 150 entries</div>
            <div class="mt-3 w-full sm:ms-auto sm:mt-0 sm:w-auto md:ms-0">
                <div class="relative w-56 text-slate-500">
                    <base-form-input type="text" class="!box w-56 pe-10" placeholder="Search..." />
                    <svg-loader name="icon-search" class="absolute inset-y-0 end-0 my-auto me-3 h-4 w-4" />
                </div>
            </div>
        </div>
    </div>

    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <base-table class="-mt-2 border-separate border-spacing-y-[10px]">
            <base-thead-table>
                <base-tr-table>
                    <base-th-table class="whitespace-nowrap border-b-0"> #</base-th-table>
                    <base-th-table class="whitespace-nowrap border-b-0"> family name</base-th-table>
                    <base-th-table class="whitespace-nowrap border-b-0 text-center"> file number</base-th-table>
                    <base-th-table class="whitespace-nowrap border-b-0 text-center"> zone</base-th-table>
                    <base-th-table class="whitespace-nowrap border-b-0 text-center"> start data</base-th-table>
                    <base-th-table class="whitespace-nowrap border-b-0 text-center"> ACTIONS</base-th-table>
                </base-tr-table>
            </base-thead-table>
            <base-tbody-table>
                <base-tr-table class="intro-x">
                    <base-td-table
                        class="w-40 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600"
                    >
                        1
                    </base-td-table>
                    <base-td-table
                        class="border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600"
                    >
                        <a href="" class="whitespace-nowrap font-medium"> test </a>
                    </base-td-table>
                    <base-td-table
                        class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600"
                    >
                        212145
                    </base-td-table>
                    <base-td-table
                        class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600"
                    >
                        zone number 1
                    </base-td-table>
                    <base-td-table
                        class="w-40 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600"
                    >
                        <div
                            :class="[
                                'flex items-center justify-center',
                                { 'text-success': true },
                                { 'text-danger': false }
                            ]"
                        >
                            2024/20/02
                        </div>
                    </base-td-table>
                    <base-td-table
                        class="relative w-56 border-b-0 bg-white py-0 shadow-[20px_3px_20px_#0000000b] before:absolute before:inset-y-0 before:start-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 before:dark:bg-darkmode-400"
                    >
                        <div class="flex items-center justify-center">
                            <a class="me-3 flex items-center" href="#">
                                <svg-loader name="icon-pen" class="me-1 h-4 w-4" />
                                Edit
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
                                Delete
                            </a>
                        </div>
                    </base-td-table>
                </base-tr-table>
            </base-tbody-table>
        </base-table>
    </div>
</template>
