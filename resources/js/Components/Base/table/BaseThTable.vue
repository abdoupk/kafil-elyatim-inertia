<script setup lang="ts">
import { computed, inject } from 'vue'
import type { ProvideTable } from './BaseTable.vue'
import type { ProvideThead } from './BaseTheadTable.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

defineOptions({
    inheritAttrs: false
})

const { sortable = false, direction = 'asc' } = defineProps<{
    sortable?: boolean
    field?: string
    direction?: 'asc' | 'desc'
}>()

const table = inject<ProvideTable>('table', {
    dark: false,
    bordered: false,
    hover: false,
    striped: false,
    sm: false
})

const thead = inject<ProvideThead>('thead', {
    variant: 'default'
})

const attrs = useComputedAttrs()

const computedClass = computed(() =>
    twMerge([
        'font-medium px-5 py-3 border-b-2 dark:border-darkmode-300',
        thead?.variant === 'light' && 'border-b-0 text-slate-700',
        thead?.variant === 'dark' && 'border-b-0',
        table?.dark && 'border-slate-600 dark:border-darkmode-300',
        table?.bordered && 'border-l border-r border-t',
        table?.sm && 'px-4 py-2',
        typeof attrs.class === 'string' && attrs.class
    ])
)
</script>

<template>
    <th :class="computedClass" v-bind="attrs.attrs" class="flex-col">
        <div class="flex cursor-pointer" v-if="sortable">
            <span class="flex-grow">
                <slot></slot>
            </span>
            <svg-loader v-if="direction === 'asc'" name="icon-sort-up"></svg-loader>
            <svg-loader v-else name="icon-sort-down"></svg-loader>
        </div>
        <span v-else><slot></slot></span>
    </th>
</template>
