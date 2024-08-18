<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { usePage } from '@inertiajs/vue3'
import { twMerge } from 'tailwind-merge'
import { ref } from 'vue'

import BasePopover from '@/Components/Base/headless/Popover/BasePopover.vue'
import BasePopoverButton from '@/Components/Base/headless/Popover/BasePopoverButton.vue'
import BasePopoverPanel from '@/Components/Base/headless/Popover/BasePopoverPanel.vue'
import TheRealTimeNotification from '@/Components/Global/TheRealTimeNotification.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheNotificationMenu from '@/Components/top-bar/notifications/TheNotificationMenu.vue'

import { useComputedAttrs } from '@/utils/useComputedAttrs'

const attrs = useComputedAttrs()

defineOptions({
    inheritAttrs: false
})

const settingsStore = useSettingsStore()

const a = ref(false)

const notification = ref(false)

window.Echo?.private('App.Models.User.' + usePage().props.auth.user.id).notification((notification) => {
    console.log(notification)

    a.value = true
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

        <base-popover-panel
            class="scrollbar-hidden mt-2 max-h-[250px] w-[280px] overflow-y-auto scroll-smooth p-5 sm:w-[350px]"
            placement="bottom-end"
        >
            <the-notification-menu></the-notification-menu>
        </base-popover-panel>
    </base-popover>

    <the-real-time-notification :open="a" :title="notification?.data?.city"></the-real-time-notification>
</template>
