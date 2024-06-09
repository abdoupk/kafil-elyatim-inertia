<script setup lang="ts">
import { Dialog as HeadlessDialog, TransitionRoot } from '@headlessui/vue'
import { type Ref, computed, provide, ref, useAttrs } from 'vue'
import type { ExtractProps } from '@/types/utils'
import { omit } from '@/utils/helper'
import { twMerge } from 'tailwind-merge'

type Size = 'sm' | 'md' | 'lg' | 'xl'

export type ProvideDialog = {
    open: boolean
    zoom: Ref<boolean>
    size?: Size
}

interface DialogProps extends /* @vue-ignore */ ExtractProps<typeof HeadlessDialog> {
    size?: Size
    open: boolean
    staticBackdrop?: boolean
}

defineOptions({
    inheritAttrs: false
})

const { as = 'div', onClose, open = false, staticBackdrop, size = 'md' } = defineProps<DialogProps>()

const computedOpen = computed(() => open)

const attrs = useAttrs()

const computedClass = computed(() => twMerge(['relative z-[60]', typeof attrs.class === 'string' && attrs.class]))

const zoom = ref(false)

const emit = defineEmits<{
    (e: 'close', value: boolean): void
}>()

const handleClose = (value: boolean) => {
    if (!staticBackdrop) {
        onClose && onClose(value)

        emit('close', value)
    } else {
        zoom.value = true

        setTimeout(() => {
            zoom.value = false
        }, 300)
    }
}

provide<ProvideDialog>('dialog', {
    open: computedOpen.value,
    zoom: zoom,
    size: size
})
</script>

<template>
    <transition-root appear as="template" :show="open">
        <headless-dialog
            class="dialog"
            :as="as"
            @close="
                (value) => {
                    handleClose(value)
                }
            "
            :class="computedClass"
            v-bind="omit(attrs, ['onClose'])"
        >
            <slot></slot>
        </headless-dialog>
    </transition-root>
</template>

<style>
.dialog *:focus {
    outline: none !important;
}
</style>
