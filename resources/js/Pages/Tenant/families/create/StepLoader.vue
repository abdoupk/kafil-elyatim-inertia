<script lang="ts" setup>
import { onMounted, ref } from 'vue'

import SpinnerLoader from '@/Components/Global/SpinnerLoader.vue'

const ready = ref(false)

onMounted(() => {
    setTimeout(() => {
        ready.value = true
    }, 300)
})
</script>

<template>
    <Suspense v-if="ready">
        <div class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20">
            <div class="mt-5 w-full flex justify-center items-center">
                <spinner-loader class="w-8 h-8 animate-spin"></spinner-loader>
            </div>
        </div>
        <template #fallback>
            <slot name="fallback"></slot>
        </template>
    </Suspense>
</template>
