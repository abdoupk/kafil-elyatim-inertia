<script lang="ts" setup>
import type { SecondSponsorType } from '@/types/families'

import { formatCurrency, formatDate } from '@/utils/helper'

defineProps<{ secondSponsor: SecondSponsorType }>()
</script>

<template>
    <!-- BEGIN: Second Sponsor Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ secondSponsor.name }}</h2>

            <div
                class="mt-2 flex w-fit items-center truncate rounded-full bg-success/30 px-2 py-1 text-sm font-semibold text-success dark:bg-darkmode-400"
            >
                {{ $t(secondSponsor.degree_of_kinship) }}
            </div>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.second_sponsor.phone_number') }}</h2>
                <h3 class="font-medium text-base">{{ secondSponsor.phone_number }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.second_sponsor.address') }}</h2>
                <h3 class="font-medium text-base">{{ secondSponsor.address }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.second_sponsor.income') }}</h2>
                <h3 class="font-medium text-base">{{ formatCurrency(secondSponsor.income) }}</h3>
            </div>
        </div>
    </div>
    <!-- END: Second Sponsor Information -->
</template>
