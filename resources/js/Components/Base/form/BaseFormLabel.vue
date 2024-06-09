<script setup lang="ts">
import { computed, inject } from 'vue'
import type { ProvideFormInline } from './BaseFormInline.vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

defineOptions({
    inheritAttrs: false
})

const attrs = useComputedAttrs()

const formInline = inject<ProvideFormInline>('formInline', false)

const computedClass = computed(() =>
    twMerge([
        'inline-block mb-2',
        formInline && 'mb-2 sm:mb-0 sm:me-5 sm:text-right',
        typeof attrs.class === 'string' && attrs.class
    ])
)
</script>

<template>
    <label :class="computedClass" v-bind="attrs.attrs">
        <slot></slot>
    </label>
</template>
