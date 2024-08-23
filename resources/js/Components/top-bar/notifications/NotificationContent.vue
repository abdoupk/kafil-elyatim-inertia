<script lang="ts" setup>
import type { DatabaseNotification } from '@/types/types'

import { formatDate } from '@/utils/helper'
import { n__ } from '@/utils/i18n'

defineProps<{
    notification: DatabaseNotification
}>()
</script>

<template>
    <div class="ms-2 overflow-hidden">
        <div class="flex items-center">
            <a class="me-5 truncate font-medium" href="">
                {{ notification.data.user.name }}
            </a>
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
        ></div>
    </div>
</template>
