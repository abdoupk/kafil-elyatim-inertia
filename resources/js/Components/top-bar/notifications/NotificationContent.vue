<script lang="ts" setup>
import type { DatabaseNotification } from '@/types/types'

import { useNotificationsStore } from '@/stores/notifications'
import { router } from '@inertiajs/vue3'

import { formatDate } from '@/utils/helper'
import { $tc } from '@/utils/i18n'

const props = defineProps<{
    notification: DatabaseNotification
    close: () => void
}>()

const notificationsStore = useNotificationsStore()

const redirect = (url: string) => {
    if (url) {
        props.close()

        router.visit(url)
    }
}

const markAsRead = (notification: DatabaseNotification) => {
    notificationsStore.markAsRead(notification.id)

    redirect(notification.data.metadata.url)
}

const handleShowMember = (url: string) => {
    redirect(url)
}
</script>

<template>
    <div class="z-10 ms-2 overflow-hidden" @click.prevent="markAsRead(notification)">
        <div class="z-[51] flex items-center">
            <a
                class="me-5 truncate font-medium rtl:font-semibold"
                href="javascript:void(0)"
                @click.stop="handleShowMember(route('tenant.members.index') + '?show=' + notification.data.user.id)"
            >
                {{ notification.data.user.name }}
            </a>

            <div class="ms-auto whitespace-nowrap text-xs text-slate-400">
                {{ formatDate(notification.data.metadata.created_at, 'medium') }}
            </div>
        </div>

        <div
            class="mt-0.5 line-clamp-2 w-full text-slate-500"
            v-html="
                $tc(`notifications.${notification.type}`, notification.data.user.gender === 'male' ? 1 : 0, {
                    ...notification.data.data
                })
            "
        ></div>
    </div>
</template>
