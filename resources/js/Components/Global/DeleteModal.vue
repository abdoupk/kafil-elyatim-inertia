<script setup lang="ts">
import { ref } from 'vue'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseDialog from '@/Components/Base/headless/Dialog/BaseDialog.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{ open: boolean; deleteProgress: boolean }>()

const emit = defineEmits(['close', 'delete'])

const deleteButtonRef = ref(null)
</script>

<template>
    <base-dialog :open @close="emit('close')" :initialFocus="deleteButtonRef">
        <base-dialog-panel>
            <div class="p-5 text-center">
                <svg-loader name="icon-circle-x-mark" class="mx-auto mt-3 h-16 w-16 text-danger"></svg-loader>
                <div class="mt-5 text-3xl">{{ $t('Are you sure?') }}</div>
                <div class="mt-2 text-slate-500">
                    {{ $t('Do you really want to delete this record?') }} <br />
                    {{ $t('This process cannot be undone.') }}
                </div>
            </div>
            <div class="flex justify-center px-5 pb-8 text-center">
                <base-button type="button" variant="outline-secondary" @click="emit('close')" class="me-2 w-24">
                    {{ $t('cancel') }}
                </base-button>
                <base-button
                    @click="emit('delete')"
                    :disabled="deleteProgress"
                    type="button"
                    variant="danger"
                    class="w-24"
                    ref="{deleteButtonRef}"
                >
                    <spinner-button-loader :show="deleteProgress"></spinner-button-loader>

                    {{ $t('delete') }}
                </base-button>
            </div>
        </base-dialog-panel>
    </base-dialog>
</template>
