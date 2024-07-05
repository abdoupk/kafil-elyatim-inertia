<script lang="ts" setup>
import type { SponsorType } from '@/types/families'

import { formatCurrency, formatDate, omit } from '@/utils/helper'

defineProps<{ sponsor: SponsorType }>()
</script>

<template>
    <!-- BEGIN: Sponsor Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ sponsor.name }}</h2>

            <div
                class="mt-2 flex w-fit items-center truncate rounded-full bg-success/30 px-2 py-1 text-sm font-semibold text-success dark:bg-darkmode-400"
            >
                {{ $t(sponsor.sponsor_type) }}
            </div>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sponsor.father_name') }}</h2>
                <h3 class="font-medium text-base">{{ sponsor.father_name }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sponsor.mother_name') }}</h2>
                <h3 class="font-medium text-base">{{ sponsor.mother_name }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sponsor.function') }}</h2>
                <h3 class="font-medium text-base">{{ sponsor.function }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sponsor.academic_level') }}</h2>
                <h3 class="font-medium text-base">{{ sponsor.academic_level }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sponsor.diploma') }}</h2>
                <h3 class="font-medium text-base">{{ sponsor.diploma }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sponsor.health_status') }}</h2>
                <h3 class="font-medium text-base">{{ sponsor.health_status }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sponsor.birth_date') }}</h2>
                <h3 class="font-medium text-base">{{ formatDate(sponsor.birth_date, 'long') }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">
                    {{ $t('validation.attributes.sponsor.birth_certificate_number') }}
                </h2>
                <h3 class="font-medium text-base">{{ sponsor.birth_certificate_number }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sponsor.card_number') }}</h2>
                <h3 class="font-medium text-base">{{ sponsor.card_number }}</h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('ccp') }}</h2>
                <h3 class="font-medium text-base">{{ sponsor.ccp }}</h3>
            </div>
        </div>
    </div>
    <!-- END: Sponsor Information -->

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
