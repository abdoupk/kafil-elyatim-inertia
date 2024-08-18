<script lang="ts" setup>
import { provide, ref, watch } from 'vue'

import BaseNotification, { type NotificationElement } from '@/Components/Base/notification/BaseNotification.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const realtimeNotification = ref<NotificationElement>()

provide('bind[realtimeNotification]', (el: NotificationElement) => {
    realtimeNotification.value = el
})

const props = defineProps<{ open: boolean; title: string; message?: string }>()

const notificationQueue: { title: string; message?: string }[] = []

let isDisplayingNotification = false

watch(props, (value) => {
    console.log('45454')

    if (value.open) {
        addToQueue(value.title, value.message)

        console.log('1212121')

        showNextNotification()
    }
})

function addToQueue(title: string, message?: string) {
    notificationQueue.push({ title, message })
}

function showNextNotification() {
    if (isDisplayingNotification || notificationQueue.length === 0) return

    isDisplayingNotification = true

    const { title, message } = notificationQueue.shift()!

    realtimeNotification.value?.showToast()

    isDisplayingNotification = false

    // Show the next notification after the current one is dismissed
    realtimeNotification.value?.addEventListener('close', showNextNotification)
}
</script>

<template>
    <base-notification
        :options="{
            duration: 3000,
            gravity: 'top',
            position: 'right'
        }"
        class="flex"
        data-test="realtimeNotification"
        refKey="realtimeNotification"
    >
        <svg-loader class="h-4 w-4 fill-success" name="icon-check-circle"></svg-loader>

        <div class="mx-4">
            <div class="font-medium">
                {{ props.title }}
            </div>
            <div v-if="props.message" class="mt-1 text-slate-500">{{ props.message }}}</div>
        </div>
    </base-notification>
</template>
