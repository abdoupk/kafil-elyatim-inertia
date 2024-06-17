<script setup lang="ts">
import TheLayout from '@/Layouts/TheLayout.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{ family: object }>()
</script>

<template>
    {{ family }}
    details
</template>
