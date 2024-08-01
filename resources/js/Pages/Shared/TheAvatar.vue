<script lang="ts" setup>
defineProps<{
    gender?: 'male' | 'female' | null
    name: string
}>()
</script>

<template>
    <img
        v-if="gender === 'female'"
        :alt="name"
        class="rounded-full p-0.5 border border-slate-400/65 dark:border-darkmode-200"
        src="/images/female-avatar.png"
    />

    <img
        :alt="name"
        class="rounded-full p-0.5 border border-slate-400/65 dark:border-darkmode-200"
        src="/images/male-avatar.svg"
    />
</template>
