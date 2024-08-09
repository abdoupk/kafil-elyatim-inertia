<script lang="ts" setup>
import type { SecondSponsorType } from '@/types/families'

import { formatCurrency } from '@/utils/helper'

defineProps<{ secondSponsor: SecondSponsorType }>()
</script>

<template>
    <!-- BEGIN: Second Sponsor Information -->
    <div class="intro-y box col-span-12 @container 2xl:col-span-6">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-3">
            <h2 class="me-auto text-xl font-bold">{{ secondSponsor.name }}</h2>

            <div
                class="mt-2 flex w-fit items-center truncate rounded-full bg-success/30 px-2 py-1 text-sm font-semibold text-success dark:bg-darkmode-400"
            >
                {{ $t(secondSponsor.degree_of_kinship) }}
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 p-5">
            <div class="col-span-12 @xl:col-span-6">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.second_sponsor.phone_number') }}</h2>
                <h3 class="text-base font-medium">{{ secondSponsor.phone_number }}</h3>
            </div>

            <div class="col-span-12 @xl:col-span-6">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.second_sponsor.address') }}</h2>
                <h3 class="text-base font-medium">{{ secondSponsor.address }}</h3>
            </div>

            <div class="col-span-12 @xl:col-span-6">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.second_sponsor.income') }}</h2>
                <h3 class="text-base font-medium">{{ formatCurrency(secondSponsor.income) }}</h3>
            </div>
        </div>
    </div>
    <!-- END: Second Sponsor Information -->
</template>
