<script lang="ts" setup>
import { useNotificationsStore } from '@/stores/notifications'
import { useIntersectionObserver } from '@vueuse/core'
import { defineAsyncComponent, onMounted, ref } from 'vue'

import NotificationLoader from '@/Components/top-bar/notifications/NotificationLoader.vue'

const NotificationAvatar = defineAsyncComponent(
    () => import('@/Components/top-bar/notifications/NotificationAvatar.vue')
)

const NotificationContent = defineAsyncComponent(
    () => import('@/Components/top-bar/notifications/NotificationContent.vue')
)

const last = ref()

const loading = ref(false)

const notificationsStore = useNotificationsStore()

onMounted(async () => {
    loading.value = true

    await notificationsStore.getNotifications()

    loading.value = false
})

useIntersectionObserver(last, ([{ isIntersecting }]) => {
    if (!isIntersecting) {
        return
    }

    if (notificationsStore.notifications?.links.next) {
        loading.value = true

        notificationsStore.loadMoreNotifications().finally(() => {
            loading.value = false
        })
    }
})
</script>

<template>
    <div class="mb-5 font-medium">{{ $t('notifications') }}</div>

    <div v-if="notificationsStore.notifications?.data?.length">
        <div
            v-for="notification in notificationsStore.notifications?.data"
            :key="notification.id"
            :class="['relative flex cursor-pointer items-center', { 'mt-5': notification.id }]"
        >
            <notification-avatar
                :gender="notification.data.user?.gender"
                :name="notification.data.user?.name"
            ></notification-avatar>

            <notification-content :notification="notification"></notification-content>
        </div>
    </div>

    <div v-if="!loading && !notificationsStore.notifications?.data?.length" class="flex items-center justify-center">
        {{ $t('no_notifications') }}
    </div>

    <notification-loader v-if="loading"></notification-loader>

    <div ref="last" class="-translate-y-2"></div>
</template>
