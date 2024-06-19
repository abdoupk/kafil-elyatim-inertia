<script setup lang="ts">
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseDialog from '@/Components/Base/headless/Dialog/BaseDialog.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import SpinnerLoader from '@/Components/Global/SpinnerLoader.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import { TransitionRoot } from '@headlessui/vue'
import { ref } from 'vue'

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
                    <transition-root
                        :show="deleteProgress"
                        enter="transition ease-out"
                        enterFrom="scale-0"
                        enterTo="scale-100"
                    >
                        <spinner-loader class="me-1 h-4 w-4 animate-spin text-white"></spinner-loader>
                    </transition-root>

                    {{ $t('delete') }}
                </base-button>
            </div>
        </base-dialog-panel>
    </base-dialog>
</template>
