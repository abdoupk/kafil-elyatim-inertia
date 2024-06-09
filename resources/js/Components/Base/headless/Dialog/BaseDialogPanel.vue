<script setup lang="ts">
import { DialogPanel as HeadlessDialogPanel, TransitionChild } from '@headlessui/vue'
import { computed, inject } from 'vue'
import type { ExtractProps } from '@/types/utils'
import type { ProvideDialog } from './BaseDialog.vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

interface PanelProps extends /* @vue-ignore */ ExtractProps<typeof HeadlessDialogPanel> {
    as?: string | object
}

defineOptions({
    inheritAttrs: false
})

const { as = 'div' } = defineProps<PanelProps>()

const dialog = inject<ProvideDialog>('dialog')

const attrs = useComputedAttrs()

const computedClass = computed(() =>
    twMerge([
        'w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-transform dark:bg-darkmode-600',
        dialog?.size == 'md' && 'sm:w-[460px]',
        dialog?.size == 'sm' && 'sm:w-[300px]',
        dialog?.size == 'lg' && 'sm:w-[600px]',
        dialog?.size == 'xl' && 'sm:w-[600px] lg:w-[900px]',
        dialog?.zoom.value && 'scale-105',
        typeof attrs.class === 'string' && attrs.class
    ])
)
</script>

<template>
    <transition-child
        as="div"
        enter="ease-in-out duration-500"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in-out duration-[400ms]"
        leave-from="opacity-100"
        leave-to="opacity-0"
        class="fixed inset-0 bg-black/60"
        aria-hidden="true"
    />
    <transition-child
        as="div"
        enter="ease-in-out duration-500"
        enter-from="opacity-0 -mt-16"
        enter-to="opacity-100 mt-16"
        entered="opacity-100 mt-16"
        leave="ease-in-out duration-[400ms]"
        leave-from="opacity-100 mt-16"
        leave-to="opacity-0 -mt-16"
        class="fixed inset-0"
    >
        <headless-dialog-panel as="template">
            <component :is="as" :class="computedClass" v-bind="attrs.attrs">
                <slot></slot>
            </component>
        </headless-dialog-panel>
    </transition-child>
</template>
