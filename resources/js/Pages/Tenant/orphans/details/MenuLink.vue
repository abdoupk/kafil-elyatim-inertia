<script lang="ts" setup>
import type { SVGType } from '@/types/types'

import { inject } from 'vue'

import SvgLoader from '@/Components/SvgLoader.vue'

interface OrphanDetailView {
    view: string
    updateView: (viewName: string) => void
}

defineProps<{
    icon: SVGType
    viewName: string
}>()

const { view, updateView } = inject('orphanDetailView') as OrphanDetailView
</script>

<template>
    <a
        :class="view === viewName ? 'rtl:font-bold text-primary' : 'font-medium'"
        class="flex items-center mt-5"
        href="javascript:void(0)"
        @click="updateView(viewName)"
    >
        <svg-loader :name="icon" class="w-5 h-5 me-2"></svg-loader>
        {{ $t(viewName) }}
    </a>
</template>
