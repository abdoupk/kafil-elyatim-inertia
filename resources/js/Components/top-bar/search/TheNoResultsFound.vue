<script lang="ts" setup>
import { twMerge } from 'tailwind-merge'

import { useComputedAttrs } from '@/utils/useComputedAttrs'

defineOptions({
    inheritAttrs: false
})

const attrs = useComputedAttrs()
</script>

<template>
    <p
        :class="twMerge(['p-4 text-sm text-gray-500', typeof attrs.class === 'string' && attrs.class])"
        v-bind="attrs.attrs"
    >
        No results found.
    </p>
</template>
