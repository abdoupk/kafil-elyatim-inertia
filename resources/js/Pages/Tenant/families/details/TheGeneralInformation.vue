<script lang="ts" setup>
import type { FamilyShowType } from '@/types/families'

import { formatDate } from '@/utils/helper'

defineProps<{ family: FamilyShowType }>()
</script>

<template>
    <!-- BEGIN: General Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ family.name }}</h2>

            <div
                class="mt-2 flex w-fit items-center truncate rounded-full bg-slate-100 px-2 py-1 text-sm font-semibold text-slate-400 dark:bg-darkmode-400"
            >
                {{ formatDate(family.start_date, 'long') }}
            </div>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.file_number') }}</h2>
                <h3 class="font-medium text-base">{{ family.file_number }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.branch_id') }}</h2>
                <h3 class="font-medium text-base">{{ family.branch }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.zone') }}</h2>
                <h3 class="font-medium text-base">{{ family.zone }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.address') }}</h2>
                <h3 class="font-medium text-base">{{ family.address }}</h3>
            </div>
        </div>
    </div>
    <!-- END: General Information -->
</template>
