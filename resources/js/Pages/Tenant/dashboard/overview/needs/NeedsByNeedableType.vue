<script lang="ts" setup>
import { n__ } from '@/utils/i18n'
</script>

<template>
    <div class="intro-y col-span-12 sm:col-span-6 2xl:col-span-3">
        <div class="box zoom-in p-5">
            <div class="flex items-center">
                <div class="w-2/4 flex-none">
                    <div class="truncate text-lg font-medium rtl:font-semibold">{{ $t('needs_by_needable_type') }}</div>

                    <div class="mt-1 text-slate-500">{{ n__('needs_count', 1) }}</div>
                </div>
                <div class="relative ms-auto flex-none">
                    <!--                <ReportDonutChart1 :height="90" :width="90" />-->
                    <!--                <div class="absolute left-0 top-0 flex h-full w-full items-center justify-center font-medium">20%</div>-->

                    chart here
                </div>
            </div>
        </div>
    </div>
</template>
