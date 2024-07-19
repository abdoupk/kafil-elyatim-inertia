<script lang="ts" setup>
import TheLayout from '@/Layouts/TheLayout.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{ lesson: any }>()
</script>

<template>
    {{ lesson }}
</template>
