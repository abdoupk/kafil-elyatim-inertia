<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { usePage } from '@inertiajs/vue3'
import { twMerge } from 'tailwind-merge'

import BasePopover from '@/Components/Base/headless/Popover/BasePopover.vue'
import BasePopoverButton from '@/Components/Base/headless/Popover/BasePopoverButton.vue'
import BasePopoverPanel from '@/Components/Base/headless/Popover/BasePopoverPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheNotificationMenu from '@/Components/top-bar/TheNotificationMenu.vue'

import { useComputedAttrs } from '@/utils/useComputedAttrs'

const attrs = useComputedAttrs()

defineOptions({
    inheritAttrs: false
})

const settingsStore = useSettingsStore()

window.Echo?.private('App.Models.User.' + usePage().props.auth.user.id).notification((notification) => {
    console.log(notification)
})
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
                :class="{ '!fill-slate-400': settingsStore.theme === 'enigma' || settingsStore.theme === 'rubick' }"
                class="dark:fill-slate-500"
                name="icon-bell"
            ></svg-loader>
        </base-popover-button>

        <base-popover-panel class="mt-2 w-[280px] p-5 sm:w-[350px]" placement="bottom-end">
            <the-notification-menu></the-notification-menu>
        </base-popover-panel>
    </base-popover>
</template>
