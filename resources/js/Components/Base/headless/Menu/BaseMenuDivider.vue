<script setup lang="ts">
import { computed } from 'vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

interface DividerProps {
    as?: string | object
}

defineOptions({
    inheritAttrs: false
})

const { as = 'div' } = defineProps<DividerProps>()

const attrs = useComputedAttrs()

const computedClass = computed(() =>
    twMerge([
        // eslint-disable-next-line array-element-newline
        'h-px my-2 -mx-2 bg-slate-200/60 dark:bg-darkmode-400',
        typeof attrs.class === 'string' && attrs.class
    ])
)
</script>

<template>
    <component :is="as" :class="computedClass" v-bind="attrs.attrs">
        <slot></slot>
    </component>
</template>
