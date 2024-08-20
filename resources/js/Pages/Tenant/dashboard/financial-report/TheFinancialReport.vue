<script lang="ts" setup>
import { router } from '@inertiajs/vue3'
import { defineAsyncComponent } from 'vue'

import { formatCurrency } from '@/utils/helper'

const BaseFormSelect = defineAsyncComponent(() => import('@/Components/Base/form/BaseFormSelect.vue'))

const ReportLineChart = defineAsyncComponent(
    () => import('@/Pages/Tenant/dashboard/financial-report/ReportLineChart.vue')
)

defineProps<{
    financialReports: {
        incomes: number[]
        expenses: number[]
        totalThisMonth: number
        totalLastMonth: number
    }
}>()

const financialSpecifications = [
    'drilling_wells',
    'monthly_sponsorship',
    'eid_el_adha',
    'eid_el_fitr',
    'other',
    'school_entry',
    'analysis',
    'therapy',
    'ramadan_basket'
]

const handleChange = (specification: string) => {
    router.get(
        route('tenant.dashboard'),
        {
            specification
        },
        {
            preserveState: true,
            preserveScroll: true,
            only: ['financialReports']
        }
    )
}
</script>

<template>
    <suspense suspensible>
        <div>
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="flex">
                    <div>
                        <div class="text-lg font-medium text-primary dark:text-slate-300 xl:text-xl">
                            {{ formatCurrency(financialReports.totalThisMonth) }}
                        </div>

                        <div class="mt-0.5 text-slate-500 ltr:capitalize">{{ $t('this_month') }}</div>
                    </div>

                    <div
                        class="mx-4 h-12 w-px border border-e border-dashed border-slate-200 dark:border-darkmode-300 xl:mx-5"
                    ></div>

                    <div>
                        <div class="text-lg font-medium text-slate-500 xl:text-xl">
                            {{ formatCurrency(financialReports.totalLastMonth) }}
                        </div>
                        <div class="mt-0.5 text-slate-500 ltr:capitalize">{{ $t('last_month') }}</div>
                    </div>
                </div>

                <div class="ms-auto">
                    <base-form-select @update:model-value="handleChange">
                        <option value="">{{ $t('all') }}</option>

                        <option v-for="option in financialSpecifications" :key="option" :value="option">
                            {{ $t(option) }}
                        </option>
                    </base-form-select>
                </div>
            </div>

            <div>
                <ReportLineChart :financialReports :height="275" class="-mb-6 mt-6" />
            </div>
        </div>
    </suspense>
</template>
