<script lang="ts" setup>
import { n__ } from '@/utils/i18n'
</script>

<template>
    <div class="intro-y col-span-12 sm:col-span-6 2xl:col-span-3">
        <div class="box zoom-in p-5">
            <div class="flex">
                <div class="me-3 truncate text-lg font-medium rtl:font-semibold">{{ $t('total_orphans') }}</div>
                <div
                    class="ms-auto flex cursor-pointer items-center truncate rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-500 dark:bg-darkmode-400"
                >
                    {{ n__('total_orphans_count', 1) }}
                </div>
            </div>
            <div class="mt-1">
                <!--                <SimpleLineChart1 :height="58" class="-ml-1" />-->

                chart here
            </div>
        </div>
    </div>
</template>
