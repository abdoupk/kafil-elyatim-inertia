<script lang="ts" setup>
import { onMounted, ref } from 'vue'

const ready = ref(false)

onMounted(() => {
    setTimeout(() => {
        ready.value = true
    }, 0)
})
</script>

<template>
    <Suspense v-if="ready">
        <div class="">icewall side menu loader</div>
        <template #fallback>
            <slot name="fallback"></slot>
        </template>
    </Suspense>
</template>
