<script lang="ts" setup>
import type { SponsorShowType } from '@/types/sponsors'

import { formatCurrency, omit } from '@/utils/helper'

defineProps<{ sponsor: SponsorShowType }>()
</script>

<template>
    <!-- BEGIN: Incomes -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('income information') }}</h2>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div v-for="(income, key) in omit(sponsor.incomes, ['id'])" :key class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">
                    {{ $t(`incomes.label.${key}`) }}
                </h2>

                <h3 class="font-medium text-base">{{ formatCurrency(income) }}</h3>
            </div>
        </div>
    </div>
    <!-- END: Incomes -->
</template>
