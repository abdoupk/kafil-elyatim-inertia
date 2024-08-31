<script lang="ts" setup>
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'

import { $t } from '@/utils/i18n'

const props = defineProps<{
    status: number
}>()

const title = computed(() => {
    return {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden'
    }[props.status]
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.'
    }[props.status]
})
</script>

<template>
    <Head :title="$t(`http-statuses.${String(status)}`)"></Head>

    <div>
        <H1>{{ title }}</H1>
        <div>{{ description }}</div>
    </div>
</template>
