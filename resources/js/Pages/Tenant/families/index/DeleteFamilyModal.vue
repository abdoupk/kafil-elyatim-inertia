<script setup lang="ts">
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseDialog from '@/Components/Base/headless/Dialog/BaseDialog.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import { ref } from 'vue'

defineProps<{ open: boolean }>()

const emit = defineEmits(['close', 'delete'])

const deleteButtonRef = ref(null)
</script>

<template>
    <base-dialog :open @close="emit('close')" :initialFocus="deleteButtonRef">
        <base-dialog-panel>
            <div class="p-5 text-center">
                <svg-loader name="icon-circle-x-mark" class="mx-auto mt-3 h-16 w-16 text-danger"></svg-loader>
                <div class="mt-5 text-3xl">{{ __('Are you sure?') }}</div>
                <div class="mt-2 text-slate-500">
                    {{ __('Do you really want to delete this record?') }} <br />
                    {{ __('This process cannot be undone.') }}
                </div>
            </div>
            <div class="px-5 pb-8 text-center">
                <base-button type="button" variant="outline-secondary" @click="emit('close')" class="me-1 w-24">
                    {{ __('cancel') }}
                </base-button>
                <base-button
                    @click="emit('delete')"
                    type="button"
                    variant="danger"
                    class="w-24"
                    ref="{deleteButtonRef}"
                >
                    {{ __('delete') }}
                </base-button>
            </div>
        </base-dialog-panel>
    </base-dialog>
</template>
