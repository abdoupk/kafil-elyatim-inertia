<script setup lang="ts">
import type { ExtractProps } from '@/types/utils'
import { MenuItem as HeadlessMenuItem } from '@headlessui/vue'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

interface ItemProps extends /* @vue-ignore */ ExtractProps<typeof HeadlessMenuItem> {
    method?: 'get' | 'post' | 'put' | 'patch' | 'delete'
    href?: string
}

defineOptions({
    inheritAttrs: false
})

const { href = route('tenant.dashboard'), method = 'get' } = defineProps<ItemProps>()

const attrs = useComputedAttrs()

const computedClass = computed(() =>
    twMerge([
        'cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 w-full dark:hover:bg-darkmode-400', typeof attrs.class === 'string' && attrs.class
    ])
)
</script>

<template>
    <headless-menu-item as="template">
        <Link :href="href" :method="method" :class="computedClass" v-bind="attrs.attrs" as="button">
            <slot></slot>
        </Link>
    </headless-menu-item>
</template>
