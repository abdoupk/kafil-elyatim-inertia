<script lang="ts" setup>
import type { DatabaseNotification, PaginationData } from '@/types/types'

import { useIntersectionObserver } from '@vueuse/core'
import axios from 'axios'
import { onMounted, ref } from 'vue'

import NotificationAvatar from '@/Components/top-bar/notifications/NotificationAvatar.vue'
import NotificationContent from '@/Components/top-bar/notifications/NotificationContent.vue'
import NotificationLoader from '@/Components/top-bar/notifications/NotificationLoader.vue'

const last = ref()

const notifications = ref<PaginationData<DatabaseNotification>>()

const loading = ref(false)

onMounted(() => {
    axios.get('/dashboard/notifications').then((response) => {
        notifications.value = response.data

        loading.value = false
    })
})

const { stop } = useIntersectionObserver(last, ([{ isIntersecting }]) => {
    if (!isIntersecting) {
        return
    }

    loading.value = true

    axios.get(notifications.value?.links.next).then((res) => {
        notifications.value.data = [...notifications.value?.data, ...res.data.data]

        notifications.value.meta = res.data.meta

        notifications.value.links = res.data.links

        setTimeout(() => {
            loading.value = false
        }, 300)

        if (!res.data.meta.next_cursor) {
            stop()
        }
    })
})
</script>

<template>
    <div class="mb-5 font-medium">{{ $t('notifications') }}</div>

    <div v-if="notifications?.data?.length">
        <div
            v-for="notification in notifications?.data"
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

    <div v-else class="flex items-center justify-center">no no</div>

    <div ref="last" class="-translate-y-2"></div>

    <notification-loader v-if="loading"></notification-loader>
</template>
