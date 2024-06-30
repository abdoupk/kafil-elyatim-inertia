<script setup lang="ts">
import type { ExtractProps } from '@/types/utils'

import { TabList as HeadlessTabList } from '@headlessui/vue'
import { twMerge } from 'tailwind-merge'
import { computed, provide } from 'vue'

import { useComputedAttrs } from '@/utils/useComputedAttrs'

type Variant = 'tabs' | 'pills' | 'boxed-tabs' | 'link-tabs'

export type ProvideList = {
    variant?: Variant
}

interface ListProps extends /* @vue-ignore */ ExtractProps<typeof HeadlessTabList> {
    variant?: Variant
}

defineOptions({
    inheritAttrs: false
})

const { variant = 'tabs' } = defineProps<ListProps>()

const attrs = useComputedAttrs()

const computedClass = computed(() =>
    twMerge([
        variant == 'tabs' && 'border-b border-slate-200 dark:border-darkmode-400',
        'w-1/2 flex flex-col items-center mx-auto sm:w-full md:flex-row',
        typeof attrs.class === 'string' && attrs.class
    ])
)

provide<ProvideList>('list', {
    variant: variant
})
</script>

<template>
    <headless-tab-list as="ul" :class="computedClass" v-bind="attrs.attrs">
        <slot></slot>
    </headless-tab-list>
</template>
