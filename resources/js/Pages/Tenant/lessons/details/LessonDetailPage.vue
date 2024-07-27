<script lang="ts" setup>
import TheLayout from '@/Layouts/TheLayout.vue'
import type { LessonShowType } from '@/types/lessons'

defineOptions({
    layout: TheLayout
})

defineProps<{ lesson: LessonShowType }>()
</script>

<template>
    {{ lesson }}
</template>
