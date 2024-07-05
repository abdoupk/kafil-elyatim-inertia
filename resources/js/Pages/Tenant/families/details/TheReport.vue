<script lang="ts" setup>
import type { PreviewType } from '@/types/families'

defineProps<{ preview: PreviewType }>()
</script>

<template>
    <!-- BEGIN: The Report -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('the_report') }}</h2>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="@xl:col-span-6 col-span-12">
                <div>{{ preview?.report }}</div>
            </div>
        </div>
    </div>
    <!-- END: The Report -->
</template>
