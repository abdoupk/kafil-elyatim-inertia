<script setup lang="ts">
import { computed } from 'vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

interface FooterProps {
    as?: string | object
}

defineOptions({
    inheritAttrs: false
})

const { as = 'div' } = defineProps<FooterProps>()

const attrs = useComputedAttrs()

const computedClass = computed(() => twMerge(['flex p-1', typeof attrs.class === 'string' && attrs.class]))
</script>

<template>
    <component :is="as" :class="computedClass" v-bind="attrs.attrs">
        <slot></slot>
    </component>
</template>
