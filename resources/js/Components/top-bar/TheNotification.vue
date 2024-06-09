<script lang="ts" setup>
import BasePopover from '@/Components/Base/headless/Popover/BasePopover.vue'
import BasePopoverButton from '@/Components/Base/headless/Popover/BasePopoverButton.vue'
import BasePopoverPanel from '@/Components/Base/headless/Popover/BasePopoverPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheNotificationMenu from '@/Components/top-bar/TheNotificationMenu.vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'
import { useSettingsStore } from '@/stores/settings'

const attrs = useComputedAttrs()

defineOptions({
    inheritAttrs: false
})

const settingsStore = useSettingsStore()
</script>

<template>
    <base-popover class="intro-x me-auto sm:me-6">
        <base-popover-button
            :class="
                twMerge(
                    'relative block text-slate-600 outline-none before:absolute before:end-0.5 before:top-[-2px] before:h-[8px] before:w-[8px] before:rounded-full before:bg-danger before:content-[\'\']',
                    typeof attrs.class === 'string' && attrs.class
                )
            "
            v-bind="attrs.attrs"
        >
            <svg-loader
                name="icon-bell"
                class="dark:fill-slate-500"
                :class="{ '!fill-slate-400': settingsStore.theme === 'enigma' || settingsStore.theme === 'icewall' }"
            ></svg-loader>
        </base-popover-button>

        <base-popover-panel placement="bottom-end" class="mt-2 w-[280px] p-5 sm:w-[350px]">
            <the-notification-menu></the-notification-menu>
        </base-popover-panel>
    </base-popover>
</template>
