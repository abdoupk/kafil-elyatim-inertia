<script setup lang="ts">
import { useSettingsStore } from '@/stores/settings'
import { twMerge } from 'tailwind-merge'

import { layouts } from '@/utils/constants'

const settingsStore = useSettingsStore()
</script>

<template>
    <div class="px-8 pb-8 pt-6">
        <div class="text-base font-medium">Layouts</div>
        <div class="mt-0.5 text-slate-500">Choose your layout</div>
        <div class="mt-5 grid grid-cols-3 gap-x-5 gap-y-3.5">
            <template v-for="layout in layouts" :key="layout">
                <div>
                    <a
                        @click.prevent="settingsStore.changeLayout(layout)"
                        :class="
                            twMerge([
                                'box block h-24 cursor-pointer bg-slate-50 p-1',
                                settingsStore?.layout === layout
                                    ? 'border-2 border-theme-1/60 dark:border-darkmode-50'
                                    : ''
                            ])
                        "
                    >
                        <div class="image-fit h-full w-full overflow-hidden rounded-md">
                            <img
                                :alt="layout"
                                class="h-full w-full"
                                :src="`/images/layouts/${layout.replace('_', '-')}.png`"
                            />
                        </div>
                    </a>
                    <div class="mt-2.5 text-center text-xs capitalize">
                        {{ layout.replace('_', '-') }}
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
