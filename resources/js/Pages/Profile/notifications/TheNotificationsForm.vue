<script lang="ts" setup>
import TheNotificationItem from '@/Pages/Profile/notifications/TheNotificationItem.vue'
</script>

<template>
    <div class="border-b pb-5">
        <h2 class="rtl:text-xl rtl:font-semibold">{{ $t('appearance') }}</h2>

        <p class="mt-1 text-slate-600 dark:text-slate-400">
            {{ $t('theme.profile_appearance_hint') }}
        </p>
    </div>

    <p class="py-5">Notify me about...</p>

    <div class="space-y-4">
        <the-notification-item description="test" label="test"></the-notification-item>

        <the-notification-item description="test2" label="test2"></the-notification-item>

        <the-notification-item description="test3" label="test3"></the-notification-item>
    </div>
</template>
