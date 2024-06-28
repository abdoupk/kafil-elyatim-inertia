<script lang="ts">
/* eslint-disable vue/no-parsing-error */
import type { ILPConfiguration } from 'litepicker/dist/types/interfaces'

type LitepickerConfig = Partial<ILPConfiguration>
</script>

<script setup lang="ts">
// eslint-disable-next-line sort-imports
import { type InputHTMLAttributes, inject, onMounted, ref } from 'vue'
import { init, reInit, setValue } from './index'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import LitepickerJs from 'litepicker'
import SvgLoader from '@/Components/SvgLoader.vue'

export interface LitepickerElement extends HTMLInputElement {
    litePickerInstance: LitepickerJs
}

export interface LitepickerEmit {
    (e: 'update:modelValue', value: string): void
}

export interface LitepickerProps extends /* @vue-ignore */ InputHTMLAttributes {
    options: {
        format?: string | undefined
    } & LitepickerConfig
    modelValue: string
    refKey?: string
}

export type ProvideLitepicker = (el: LitepickerElement) => void

const props = defineProps<LitepickerProps>()

const litepickerRef = ref<LitepickerElement>()

const tempValue = ref(props.modelValue)

const emit = defineEmits<LitepickerEmit>()

const vLitepickerDirective = {
    mounted(el: LitepickerElement) {
        setValue(props, emit)

        init(el, props, emit)
    },
    updated(el: LitepickerElement) {
        if (tempValue.value !== props.modelValue && el !== null) {
            reInit(el, props, emit)

            tempValue.value = props.modelValue
        }
    }
}

const bindInstance = (el: LitepickerElement) => {
    if (props.refKey) {
        const bind = inject<ProvideLitepicker>(`bind[${props.refKey}]`)

        if (bind) {
            bind(el)
        }
    }
}

onMounted(() => {
    if (litepickerRef.value) {
        bindInstance(litepickerRef.value)
    }
})
</script>

<template>
    <div class="relative">
        <div
            class="absolute flex items-center justify-center w-10 h-full border rounded-s bg-slate-100 text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"
        >
            <svg-loader name="icon-calendar" class="w-4 h-4 fill-current" />
        </div>

        <base-form-input
            class="ps-12"
            ref="litepickerRef"
            type="text"
            :value="props.modelValue"
            @change="
                (event: Event) => {
                    emit('update:modelValue', (event.target as HTMLInputElement).value)
                }
            "
            v-litepicker-directive
        />
    </div>
</template>
<style lang="postcss">
@import '/resources/css/vendors/litepicker.css';
</style>
