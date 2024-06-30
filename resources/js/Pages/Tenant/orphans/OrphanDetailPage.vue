<script lang="ts" setup>
import type { OrphanType } from '@/types/types'

import TheLayout from '@/Layouts/TheLayout.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{
    orphan: OrphanType
}>()
</script>

<template>{{ orphan }}</template>
