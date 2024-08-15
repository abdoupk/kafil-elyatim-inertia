<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { twMerge } from 'tailwind-merge'

import { colorSchemes } from '@/utils/constants'

const settingsStore = useSettingsStore()

const theAccentColor = defineModel('theAccentColor')

theAccentColor.value = settingsStore.colorScheme
</script>

<template>
    <div class="mt-5">
        <div class="font-semibold">{{ $t('theme.accent_color') }}</div>

        <div class="mt-0.5 text-slate-500">{{ $t('theme.accent_color_hint') }}</div>

        <div class="mt-5 grid grid-cols-2 gap-3.5">
            <template v-for="colorScheme in colorSchemes" :key="colorScheme">
                <div>
                    <a
                        :class="
                            twMerge([
                                'box block h-14 cursor-pointer border-slate-300/80 bg-slate-50 p-1',
                                '[&.active]:border-2 [&.active]:border-theme-1/60',
                                theAccentColor === colorScheme ? 'active' : ''
                            ])
                        "
                        @click.prevent="theAccentColor = colorScheme"
                    >
                        <div class="h-full overflow-hidden rounded-md">
                            <div class="-mx-2 flex h-full items-center gap-1">
                                <div :class="twMerge(['h-[200%] w-1/2 rotate-12 bg-theme-1', colorScheme])"></div>

                                <div :class="twMerge(['h-[200%] w-1/2 rotate-12 bg-theme-2', colorScheme])"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </template>
        </div>
    </div>
</template>
