<script lang="ts" setup>
defineProps<{
    test: unknown
}>()
</script>

<template>
    <pre>
        {{ test }}
    </pre>
</template>
