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
            <a class="me-5 font-medium truncate" href="">
                {{ notification.data.user.name }}
            </a>
            <div class="ms-auto text-xs text-slate-400 whitespace-nowrap">
                {{ formatDate(notification.data.metadata.created_at, 'medium') }}
            </div>
        </div>
        <div
            class="w-full line-clamp-2 text-slate-500 mt-0.5"
            v-html="n__(`notifications.${notification.type}`, 0, { ...notification.data.data })"
        ></div>
    </div>
</template>
