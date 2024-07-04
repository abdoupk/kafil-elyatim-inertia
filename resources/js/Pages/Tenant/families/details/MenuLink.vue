<script lang="ts" setup>
import SvgLoader from '@/Components/SvgLoader.vue'
import { inject } from 'vue'
import type { SVGType } from '@/types/types'

interface FamilyDetailView {
    view: string,
    updateView: (viewName: string) => void
}

defineProps<{
    icon: SVGType
    viewName: string
}>()

const { view, updateView } = inject('familyDetailView') as FamilyDetailView
</script>

<template>
    <a :class="view === viewName ? 'rtl:font-bold text-primary' : 'font-medium'" class="flex items-center mt-5"
       href="javascript:void(0)"
       @click="updateView(viewName)">
        <svg-loader :name="icon" class="w-4 h-4 me-2"></svg-loader>
        {{ viewName }}
    </a>
</template>
