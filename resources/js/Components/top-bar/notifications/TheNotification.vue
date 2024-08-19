<script lang="ts" setup>
import type { DatabaseNotification } from '@/types/types'

import { useNotificationsStore } from '@/stores/notifications'
import { useSettingsStore } from '@/stores/settings'
import { usePage } from '@inertiajs/vue3'
import { twMerge } from 'tailwind-merge'
import { defineAsyncComponent } from 'vue'
import { Toaster, toast } from 'vue-sonner'

import { useComputedAttrs } from '@/utils/useComputedAttrs'

const BasePopover = defineAsyncComponent(() => import('@/Components/Base/headless/Popover/BasePopover.vue'))

const BasePopoverButton = defineAsyncComponent(() => import('@/Components/Base/headless/Popover/BasePopoverButton.vue'))

const BasePopoverPanel = defineAsyncComponent(() => import('@/Components/Base/headless/Popover/BasePopoverPanel.vue'))

const SvgLoader = defineAsyncComponent(() => import('@/Components/SvgLoader.vue'))

const TheNotificationMenu = defineAsyncComponent(
    () => import('@/Components/top-bar/notifications/TheNotificationMenu.vue')
)

const attrs = useComputedAttrs()

defineOptions({
    inheritAttrs: false
})

const settingsStore = useSettingsStore()

const notificationsStore = useNotificationsStore()

window.Echo?.private('App.Models.User.' + usePage().props.auth.user.id).notification(
    (notification: DatabaseNotification) => {
        notificationsStore.addNotification(notification)

        for (let i = 0; i < 5; i++) {
            setTimeout(() => {
                toast('New notification', {
                    description: 'desc' + i
                })
            }, 1000)
        }
    }
)
</script>

<template>
    <suspense suspensible>
        <template #default>
            <div class="">
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
                            :class="{
                                '!fill-slate-400': settingsStore.theme === 'enigma' || settingsStore.theme === 'rubick'
                            }"
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

                <Toaster
                    :expand="false"
                    :toast-options="{
                        duration: 3000
                    }"
                    dir="rtl"
                />
            </div>
        </template>

        <template #fallback>7888888</template>
    </suspense>
</template>
