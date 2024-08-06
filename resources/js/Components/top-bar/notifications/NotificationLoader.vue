<script lang="ts" setup></script>

<template>
    <div v-for="index in 5" :key="index" class="mt-5 first:mt-0 rounded-md max-w-sm w-full mx-auto">
        <div class="animate-pulse flex space-x-4">
            <div class="rounded-full bg-slate-300 dark:bg-darkmode-100 h-10 w-10 me-3"></div>

            <div class="flex-1 space-y-6 py-1">
                <div class="h-2 bg-slate-300 dark:bg-darkmode-100 rounded"></div>

                <div class="space-y-3">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="h-2 bg-slate-300 dark:bg-darkmode-100 rounded col-span-2"></div>

                        <div class="h-2 bg-slate-300 dark:bg-darkmode-100 rounded col-span-1"></div>
                    </div>

                    <div class="h-2 bg-slate-300 dark:bg-darkmode-100 rounded"></div>
                </div>
            </div>
        </div>
    </div>
</template>
