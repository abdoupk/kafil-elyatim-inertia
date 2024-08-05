<script lang="ts" setup>
import type { FurnishingType, HousingType } from '@/types/families'

import { handleFurnishings, omit } from '@/utils/helper'

defineProps<{
    housing: HousingType
    furnishings: FurnishingType
}>()
</script>

<template>
    <!-- BEGIN: Housing Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('housing information') }}</h2>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('housing.label.type') }}</h2>
                <p class="font-medium text-base">
                    {{ housing.name }}
                </p>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('housing.label.info') }}</h2>
                <p class="font-medium text-base">
                    {{ housing.value }}
                </p>
            </div>

            <div
                v-for="(value, key) in omit(housing, ['id', 'name', 'value'])"
                :key
                :class="
                    // @ts-ignore
                    key !== 'other_properties' ? '@xl:col-span-6' : ''
                "
                class="col-span-12"
            >
                <h2 class="text-lg font-semibold">
                    {{ $t(`housing.label.${key}`) }}
                </h2>

                <p class="font-medium text-base">
                    {{ value }}
                </p>
            </div>
        </div>
    </div>
    <!-- END: Housing Information -->

    <!-- BEGIN: Furnishings Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">
                {{ $t('furnishings information') }}
            </h2>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div v-for="(value, key) in omit(furnishings, ['id'])" :key class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">
                    {{ $t(`furnishings.${key}`) }}
                </h2>

                <p class="font-medium text-base">
                    {{ handleFurnishings(value) }}
                </p>
            </div>
        </div>
    </div>
    <!-- END: Furnishings Information -->
</template>
