<script setup lang="ts">
import { provide, ref, watch } from 'vue'

import BaseNotification, { type NotificationElement } from '@/Components/Base/notification/BaseNotification.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const successNotification = ref<NotificationElement>()

provide('bind[successNotification]', (el: NotificationElement) => {
    successNotification.value = el
})

const props = defineProps<{ open: boolean; title: string; message?: string }>()

watch(props, (value) => {
    if (value.open) {
        successNotification.value?.showToast()
    }
})
</script>

<template>
    <base-notification
        data-test="successNotification"
        refKey="successNotification"
        :options="{
            duration: 3000,
            gravity: 'top',
            position: 'right'
        }"
        class="flex"
    >
        <svg-loader name="icon-check-circle" class="h-4 w-4 fill-success"></svg-loader>

        <div class="mx-4">
            <div class="font-medium">
                {{ props.title }}
            </div>
            <div class="mt-1 text-slate-500" v-if="props.message">{{ props.message }}}</div>
        </div>
    </base-notification>
</template>
