<script lang="ts" setup>
import NotificationAvatar from '@/Components/top-bar/notifications/NotificationAvatar.vue'
import NotificationContent from '@/Components/top-bar/notifications/NotificationContent.vue'
import NotificationLoader from '@/Components/top-bar/notifications/NotificationLoader.vue'
</script>

<template>
    <div class="mb-5 font-medium">{{ $t('notifications') }}</div>

    <div
        v-for="notification in $page.props.auth.notifications"
        :key="notification.id"
        :class="['cursor-pointer relative flex items-center', { 'mt-5': notification.id }]"
    >
        <notification-avatar
            :gender="notification.data.user?.gender"
            :name="notification.data.user?.name"
        ></notification-avatar>

        <notification-content :notification="notification"></notification-content>
    </div>

    <notification-loader></notification-loader>

    <div
        v-for="notification in $page.props.auth.notifications"
        :key="notification.id"
        :class="['cursor-pointer relative flex items-center', { 'mt-5': notification.id }]"
    >
        <notification-avatar
            :gender="notification.data.user?.gender"
            :name="notification.data.user?.name"
        ></notification-avatar>

        <notification-content :notification="notification"></notification-content>
    </div>
</template>
