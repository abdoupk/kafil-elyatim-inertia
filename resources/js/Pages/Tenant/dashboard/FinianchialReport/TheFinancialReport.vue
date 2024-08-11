<script lang="ts" setup>
import { formatCurrency } from '../../../../utils/helper'

import { router } from '@inertiajs/vue3'

import ReportLineChart from '@/Pages/Tenant/dashboard/ReportLineChart.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'

defineProps<{
    financialReports: {
        incomes: number[]
        expenses: number[]
        totalThisMonth: number
        totalLastMonth: number
    }
}>()

const handleChange = (event) => {
    console.log(event)

    router.get(
        route('tenant.dashboard'),
        {
            specification: event
        },
        {
            preserveState: true,
            preserveScroll: true,
            only: ['financialReports'],
            onSuccess: () => {
                console.log('0000')
            }
        }
    )
}
</script>

<template>
    <div class="col-span-12 mt-8 lg:col-span-6">
        <div class="intro-y block h-10 items-center sm:flex">
            <h2 class="me-5 truncate text-lg font-medium">Sales Report</h2>
            <div class="relative mt-3 text-slate-500 sm:ms-auto sm:mt-0">
                <base-v-calendar @update:date="handleChange"></base-v-calendar>
            </div>
        </div>
        <div class="intro-y box mt-12 p-5 sm:mt-5">
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="flex">
                    <div>
                        <div class="text-lg font-medium text-primary dark:text-slate-300 xl:text-xl">
                            {{ formatCurrency(financialReports.totalThisMonth) }}
                        </div>
                        <div class="mt-0.5 text-slate-500">This Month</div>
                    </div>
                    <div
                        class="mx-4 h-12 w-px border border-e border-dashed border-slate-200 dark:border-darkmode-300 xl:mx-5"
                    ></div>
                    <div>
                        <div class="text-lg font-medium text-slate-500 xl:text-xl">
                            {{ formatCurrency(financialReports.totalLastMonth) }}
                        </div>
                        <div class="mt-0.5 text-slate-500">Last Month</div>
                    </div>
                </div>

                <div class="ms-auto">
                    <base-form-select @update:model-value="handleChange">
                        <option
                            v-for="option in [
                                'drilling_wells',
                                'monthly_sponsorship',
                                'eid_el_adha',
                                'eid_el_fitr',
                                'other',
                                'school_entry',
                                'analysis',
                                'therapy',
                                'ramadan_basket'
                            ]"
                            :value="option"
                        >
                            {{ option }}
                        </option>
                    </base-form-select>
                </div>
            </div>
            <div
                :class="[
                    'relative',
                    'before:bg-gradient-to-e before:absolute before:bottom-0 before:start-0 before:top-0 before:mb-7 before:ms-10 before:block before:w-16 before:from-white before:via-white/80 before:to-transparent before:content-[\'\'] before:dark:from-darkmode-600',
                    'after:bg-gradient-to-s after:absolute after:bottom-0 after:end-0 after:top-0 after:mb-7 after:block after:w-16 after:from-white after:via-white/80 after:to-transparent after:content-[\'\'] after:dark:from-darkmode-600'
                ]"
            >
                <ReportLineChart :financialReports :height="275" class="-mb-6 mt-6" />
            </div>
        </div>
    </div>
</template>
