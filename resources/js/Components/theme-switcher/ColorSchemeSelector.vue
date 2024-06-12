<script setup lang="ts">
import type { ColorSchemesType } from '@/types/types'
import { colorSchemes } from '@/utils/constants'
import { setColorSchemeClass } from '@/utils/helper'
import { twMerge } from 'tailwind-merge'
import { useSettingsStore } from '@/stores/settings'

const settingsStore = useSettingsStore()

const switchColorScheme = (colorScheme: ColorSchemesType) => {
    settingsStore.changeColorScheme(colorScheme)

    setColorSchemeClass(colorScheme, settingsStore.appearance)
}
</script>

<template>
    <div class="px-8 pb-8 pt-6">
        <div class="text-base font-medium">Accent Colors</div>
        <div class="mt-0.5 text-slate-500">Choose your accent color</div>
        <div class="mt-5 grid grid-cols-2 gap-3.5">
            <template v-for="colorScheme in colorSchemes" :key="colorScheme">
                <div>
                    <a
                        @click="switchColorScheme(colorScheme)"
                        :class="
                            twMerge([
                                'box block h-14 cursor-pointer border-slate-300/80 bg-slate-50 p-1',
                                '[&.active]:border-2 [&.active]:border-theme-1/60',
                                colorScheme === settingsStore.colorScheme ? 'active' : ''
                            ])
                        "
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
