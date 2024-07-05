<script lang="ts" setup>
import type { SpouseType } from '@/types/families'

import { formatCurrency, formatDate } from '@/utils/helper'

defineProps<{ spouse: SpouseType }>()
</script>

<template>
    <!-- BEGIN: Spouse Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ spouse.name }}</h2>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.spouse.birth_date') }}</h2>
                <h3 class="font-medium text-base">{{ formatDate(spouse.birth_date, 'long') }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.spouse.death_date') }}</h2>
                <h3 class="font-medium text-base">{{ formatDate(spouse.death_date, 'long') }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.spouse.function') }}</h2>
                <h3 class="font-medium text-base">{{ spouse.function }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.spouse.income') }}</h2>
                <h3 class="font-medium text-base">{{ formatCurrency(spouse.income) }}</h3>
            </div>
        </div>
    </div>
    <!-- END: Spouse Information -->
</template>
