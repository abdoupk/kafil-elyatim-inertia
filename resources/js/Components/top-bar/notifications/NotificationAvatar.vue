<script lang="ts" setup>
import TheAvatar from '@/Pages/Shared/TheAvatar.vue'

defineProps<{
    gender: 'male' | 'female' | null
    name: string
}>()
</script>

<template>
    <div class="relative flex-none w-12 h-12 me-1">
        <the-avatar :gender :name class="rounded-full"></the-avatar>
    </div>
</template>
