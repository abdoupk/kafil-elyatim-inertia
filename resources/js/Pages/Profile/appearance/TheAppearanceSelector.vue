<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { twMerge } from 'tailwind-merge'

const settingsStore = useSettingsStore()
</script>

<template>
    <div class="mt-5">
        <div class="font-semibold">{{ $t('appearance') }}</div>

        <div class="mt-0.5 text-slate-500">{{ $t('theme.appearance_hint') }}</div>

        <div class="mt-5 grid grid-cols-2 gap-3.5">
            <div>
                <a
                    :class="
                        twMerge([
                            'box block h-12 cursor-pointer border-slate-300/80 bg-slate-50 p-1',
                            '[&.active]:border-2 [&.active]:border-theme-1/60',
                            settingsStore?.appearance === 'light' ? 'active' : ''
                        ])
                    "
                >
                    <div class="h-full overflow-hidden rounded-md bg-slate-200"></div>
                </a>
                <div class="mt-2.5 text-center text-xs capitalize">Light</div>
            </div>
            <div>
                <a
                    :class="
                        twMerge([
                            'box block h-12 cursor-pointer border-slate-300/80 bg-slate-50 p-1',
                            '[&.active]:border-2 [&.active]:border-theme-1/60',
                            settingsStore?.appearance === 'dark' ? 'active' : ''
                        ])
                    "
                >
                    <div class="h-full overflow-hidden rounded-md bg-slate-900"></div>
                </a>
                <div class="mt-2.5 text-center text-xs capitalize">Dark</div>
            </div>
        </div>
    </div>
</template>
