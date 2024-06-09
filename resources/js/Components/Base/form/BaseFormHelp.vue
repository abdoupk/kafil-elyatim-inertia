<script setup lang="ts">
import { computed } from 'vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

defineOptions({
    inheritAttrs: false
})

const attrs = useComputedAttrs()

const computedClass = computed(() =>
    twMerge(['text-xs text-slate-500 mt-2', typeof attrs.class === 'string' && attrs.class])
)
</script>

<template>
    <div :class="computedClass" v-bind="attrs.attrs">
        <slot></slot>
    </div>
</template>
