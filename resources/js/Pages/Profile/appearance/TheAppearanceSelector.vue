<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { twMerge } from 'tailwind-merge'

const settingsStore = useSettingsStore()

const appearance = defineModel('appearance')

appearance.value = settingsStore.appearance
</script>

<template>
    <div class="mt-5">
        <div class="font-semibold">{{ $t('appearance') }}</div>

        <div class="mt-0.5 text-slate-500">{{ $t('theme.appearance_hint') }}</div>

        <div class="mt-5 grid grid-cols-2 gap-3.5">
            <div>
                <div
                    :class="
                        twMerge([
                            '[&.active]:border-2 [&.active]:border-theme-1/60',
                            appearance === 'light' ? 'active' : ''
                        ])
                    "
                    class="cursor-pointer items-center rounded-md border-2 p-1"
                    @click.prevent="appearance = 'light'"
                >
                    <div class="space-y-2 rounded-sm bg-[#ecedef] p-2">
                        <div class="space-y-2 rounded-md bg-white p-2 shadow-sm">
                            <div class="h-2 w-20 rounded-lg bg-[#ecedef]" />
                            <div class="h-2 w-[100px] rounded-lg bg-[#ecedef]" />
                        </div>
                        <div class="flex items-center space-x-2 rounded-md bg-white p-2 shadow-sm">
                            <div class="h-4 w-4 rounded-full bg-[#ecedef]" />
                            <div class="h-2 w-[100px] rounded-lg bg-[#ecedef]" />
                        </div>
                        <div class="flex items-center space-x-2 rounded-md bg-white p-2 shadow-sm">
                            <div class="h-4 w-4 rounded-full bg-[#ecedef]" />
                            <div class="h-2 w-[100px] rounded-lg bg-[#ecedef]" />
                        </div>
                    </div>
                </div>

                <div class="mt-2.5 text-center text-xs capitalize">Light</div>
            </div>
            <div>
                <div
                    :class="
                        twMerge([
                            '[&.active]:border-2 [&.active]:border-theme-1/60',
                            appearance === 'dark' ? 'active' : ''
                        ])
                    "
                    class="cursor-pointer items-center rounded-md border-2 p-1"
                    @click.prevent="appearance = 'dark'"
                >
                    <div class="space-y-2 rounded-sm bg-slate-950 p-2">
                        <div class="space-y-2 rounded-md bg-slate-800 p-2 shadow-sm">
                            <div class="h-2 w-20 rounded-lg bg-slate-400" />
                            <div class="h-2 w-[100px] rounded-lg bg-slate-400" />
                        </div>
                        <div class="flex items-center space-x-2 rounded-md bg-slate-800 p-2 shadow-sm">
                            <div class="h-4 w-4 rounded-full bg-slate-400" />
                            <div class="h-2 w-[100px] rounded-lg bg-slate-400" />
                        </div>
                        <div class="flex items-center space-x-2 rounded-md bg-slate-800 p-2 shadow-sm">
                            <div class="h-4 w-4 rounded-full bg-slate-400" />
                            <div class="h-2 w-[100px] rounded-lg bg-slate-400" />
                        </div>
                    </div>
                </div>

                <div class="mt-2.5 text-center text-xs capitalize">Dark</div>
            </div>
        </div>
    </div>
</template>
