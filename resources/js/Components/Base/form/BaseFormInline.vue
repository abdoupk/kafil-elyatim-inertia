<script setup lang="ts">
import { computed, provide } from 'vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

export type ProvideFormInline = boolean

defineOptions({
    inheritAttrs: false
})

const attrs = useComputedAttrs()

const computedClass = computed(() =>
    twMerge(['block sm:flex items-center', typeof attrs.class === 'string' && attrs.class])
)

provide<ProvideFormInline>('formInline', true)
</script>

<template>
    <div :class="computedClass" v-bind="attrs.attrs">
        <slot></slot>
    </div>
</template>
