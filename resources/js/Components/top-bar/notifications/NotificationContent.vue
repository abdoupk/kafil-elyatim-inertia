<script lang="ts" setup>
import type { DatabaseNotification } from '@/types/types'

import { useNotificationsStore } from '@/stores/notifications'
import { Link, router } from '@inertiajs/vue3'

import { formatDate } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineProps<{
    notification: DatabaseNotification
}>()

const notificationsStore = useNotificationsStore()

const redirect = (url: string) => {
    if (url) {
        router.visit(url)
    }
}

const markAsRead = (notification: DatabaseNotification) => {
    notificationsStore.markAsRead(notification.id).then(() => {
        redirect(notification.data.metadata.url)
    })
}
</script>

<template>
    <div class="ms-2 overflow-hidden">
        <div class="flex items-center">
            <Link
                :href="route('tenant.members.index') + '?show=' + notification.data.user.id"
                class="me-5 truncate font-medium rtl:font-semibold"
            >
                {{ notification.data.user.name }}
            </Link>

            <div class="ms-auto whitespace-nowrap text-xs text-slate-400">
                {{ formatDate(notification.data.metadata.created_at, 'medium') }}
            </div>
        </div>

        <div
            class="mt-0.5 line-clamp-2 w-full text-slate-500"
            v-html="
                n__(`notifications.${notification.type}`, notification.data.user.gender === 'male' ? 1 : 0, {
                    ...notification.data.data
                })
            "
            @click.prevent="markAsRead(notification)"
        ></div>
    </div>
</template>
