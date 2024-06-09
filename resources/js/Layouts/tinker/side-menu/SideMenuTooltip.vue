<script lang="ts" setup>
import { onMounted, provide, ref } from 'vue'
import BaseTippy from '@/Components/Base/tippy/BaseTippy.vue'
import type { PopperElement } from 'tippy.js'
import { router } from '@inertiajs/vue3'

const { tag = 'span' } = defineProps<{ tag: string }>()

const tippyRef = ref<PopperElement>()

provide('bind[sideMenuTooltipRef]', (el: PopperElement) => {
    tippyRef.value = el
})

const toggleTooltip = () => {
    const el = tippyRef.value

    if (window.innerWidth <= 1260) {
        el?._tippy?.enable()
    } else {
        el?._tippy?.disable()
    }
}

const initTooltipEvent = () => {
    window.addEventListener('resize', () => {
        toggleTooltip()
    })
}

onMounted(() => {
    toggleTooltip()

    initTooltipEvent()
})

router.on('finish', () => {
    toggleTooltip()
})
</script>

<template>
    <base-tippy
        content=""
        :options="{
            placement: 'left'
        }"
        :tag="tag"
        ref-key="sideMenuTooltipRef"
    >
        <slot></slot>
    </base-tippy>
</template>
