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
    <base-form-input
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
</template>
<style lang="postcss">
@import '/resources/css/vendors/litepicker.css';
</style>
