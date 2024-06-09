<script setup lang="ts">
import { themes } from '@/utils/constants'
import { twMerge } from 'tailwind-merge'
import { useSettingsStore } from '@/stores/settings'

const settingsStore = useSettingsStore()
</script>

<template>
    <div class="px-8 pb-8 pt-6">
        <div class="text-base font-medium">Themes</div>
        <div class="mt-0.5 text-slate-500">Choose your theme</div>
        <div class="mt-5 grid grid-cols-2 gap-x-5 gap-y-3.5">
            <template v-for="theme in themes" :key="theme">
                <div @click.prevent="settingsStore.changeTheme(theme)">
                    <div
                        :class="
                            twMerge([
                                'box block h-28 cursor-pointer bg-slate-50 p-1',
                                settingsStore?.theme === theme
                                    ? 'border-2 border-theme-1/60 dark:border-darkmode-50'
                                    : ''
                            ])
                        "
                    >
                        <div class="image-fit h-full w-full overflow-hidden rounded-md">
                            <img :alt="theme" class="h-full w-full" :src="`/images/themes/${theme}.png`" />
                        </div>
                    </div>
                    <div class="mt-2.5 text-center text-xs capitalize">
                        {{ theme }}
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
