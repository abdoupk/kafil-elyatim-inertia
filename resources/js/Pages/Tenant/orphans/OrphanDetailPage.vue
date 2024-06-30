<script lang="ts" setup>
import TheLayout from '@/Layouts/TheLayout.vue'
import type { OrphanType } from '@/types/types'

defineOptions({
    layout: TheLayout
})

defineProps<{
    orphan: OrphanType
}>()
</script>

<template>{{ orphan }}</template>
