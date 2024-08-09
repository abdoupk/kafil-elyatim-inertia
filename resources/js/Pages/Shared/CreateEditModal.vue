<script lang="ts" setup>
import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseDialog from '@/Components/Base/headless/Dialog/BaseDialog.vue'
import BaseDialogDescription from '@/Components/Base/headless/Dialog/BaseDialogDescription.vue'
import BaseDialogFooter from '@/Components/Base/headless/Dialog/BaseDialogFooter.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import BaseDialogTitle from '@/Components/Base/headless/Dialog/BaseDialogTitle.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{
    open: boolean
    title: string
    loading: boolean
    modalType: 'create' | 'update'
    focusableInput?: HTMLElement
}>()

const emit = defineEmits(['close', 'handleSubmit'])
</script>

<template>
    <base-dialog :initialFocus="focusableInput" :open @close="emit('close')">
        <base-dialog-panel>
            <form @submit.prevent="emit('handleSubmit')">
                <base-dialog-title>
                    <h2 class="me-auto text-base ltr:font-medium rtl:font-semibold">
                        {{ title }}
                    </h2>

                    <a class="absolute end-0 top-0 me-3 mt-3" href="#" @click="emit('close')">
                        <svg-loader class="h-5 w-5 fill-current" name="icon-x-mark"></svg-loader>
                    </a>
                </base-dialog-title>

                <base-dialog-description class="grid grid-cols-12 gap-4 gap-y-3">
                    <slot name="description"></slot>
                </base-dialog-description>

                <base-dialog-footer class="flex justify-end">
                    <base-button class="me-1 w-20" type="button" variant="outline-secondary" @click="emit('close')">
                        {{ $t('cancel') }}
                    </base-button>

                    <base-button :disabled="loading" class="w-20" type="submit" variant="primary">
                        <spinner-button-loader :show="loading"></spinner-button-loader>

                        {{ $t(modalType) }}
                    </base-button>
                </base-dialog-footer>
            </form>
        </base-dialog-panel>
    </base-dialog>
</template>
