<script lang="ts" setup>
import type { SponsorsIndexResource } from '@/types/types'

import TheLayout from '@/Layouts/TheLayout.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{
    sponsor: SponsorsIndexResource
    //     TODO change to Sponsor Type
}>()
</script>

<template>{{ sponsor }}</template>
