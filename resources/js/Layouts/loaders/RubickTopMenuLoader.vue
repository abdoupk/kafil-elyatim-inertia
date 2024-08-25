<script lang="ts" setup>
import { onMounted, ref } from 'vue'

const ready = ref(false)

onMounted(() => {
    setTimeout(() => {
        ready.value = true
    }, 300)
})
</script>

<template>
    <Suspense v-if="ready">
        <div class="">rubick top menu loader</div>
        <template #fallback>
            <slot name="fallback"></slot>
        </template>
    </Suspense>
</template>
