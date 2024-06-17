<script setup lang="ts">
import type { SVGType } from '@/types/types'
import { defineAsyncComponent } from 'vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

defineOptions({
    inject: false
})

const props = withDefaults(defineProps<{ name: SVGType }>(), {
    name: 'loader-oval'
})

const attrs = useComputedAttrs()

// eslint-disable-next-line capitalized-comments
// noinspection TypeScriptCheckImport
const svg = defineAsyncComponent(() => import(`../../svg/${props.name}.svg`))
</script>

<template>
    <component
        :is="svg"
        :class="twMerge(['h-5 w-5 stroke-1.5', typeof attrs.class === 'string' && attrs.class])"
    ></component>
</template>
