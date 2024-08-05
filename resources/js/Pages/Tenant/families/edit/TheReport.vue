<script lang="ts" setup>
import type { PreviewType } from '@/types/families'

import { Link } from '@inertiajs/vue3'

import { formatDate } from '@/utils/helper'

defineProps<{ preview: PreviewType }>()
</script>

<template>
    <!-- BEGIN: The Report -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('the_report') }}</h2>

            <div
                class="mt-2 flex w-fit items-center truncate rounded-full bg-slate-100 px-2 py-1 text-sm font-medium text-slate-400 dark:bg-darkmode-400"
            >
                {{ formatDate(preview.preview_date, 'long') }}
            </div>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="col-span-12 prose prose-th:text-start dark:prose-invert" v-html="preview?.report"></div>

            <div class="col-span-12"></div>
        </div>
    </div>
    <!-- END: The Report -->

    <!-- BEGIN: Inspectors members -->
    <div class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">
                {{ $t('inspectors_members') }}
            </h2>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <Link
                    v-for="member in preview.inspectors"
                    :key="member.id"
                    :href="route('tenant.members.show', member.id)"
                    class="flex items-center px-5 mt-2 first:mt-0 rounded-md last:mb-3"
                >
                    <div class="w-2 h-2 bg-current rounded-full me-3"></div>

                    <span class="font-semibold text-base">{{ member.name }}</span>
                </Link>
            </div>
        </div>
    </div>
    <!-- END: Inspectors members -->
</template>
