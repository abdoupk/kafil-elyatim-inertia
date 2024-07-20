<script lang="ts" setup>
import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseDialog from '@/Components/Base/headless/Dialog/BaseDialog.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import { router } from '@inertiajs/vue3'
import type { EventApi } from '@fullcalendar/core'

defineProps<{
    open: boolean
    deleteProgress: boolean
    eventInfo: EventApi | null
}>()

const emit = defineEmits(['close', 'delete'])
</script>

<template>
    <base-dialog :open @close="emit('close')">
        <base-dialog-panel>
            <div class="p-5 leading-8 text-2xl text-center">
                {{ eventInfo?.title}}
            </div>

            <div class="flex justify-center px-5 pb-8 text-center">
                <base-button class="me-2 w-24" type="button" variant="outline-secondary" @click="emit('close')">
                    {{ $t('cancel') }}
                </base-button>

                <base-button
                    ref="{deleteButtonRef}"
                    class="w-24 me-2"
                    type="button"
                    variant="soft-warning"
                    @click="router.get(route('tenant.lessons.edit', eventInfo?.id))"
                >
                    {{ $t('edit') }}
                </base-button>

                <base-button
                    ref="{deleteButtonRef}"
                    class="w-24"
                    type="button"
                    variant="danger"
                    @click="emit('delete')"
                >
                    <spinner-button-loader :show="deleteProgress"></spinner-button-loader>

                    {{ $t('delete') }}
                </base-button>
            </div>
        </base-dialog-panel>
    </base-dialog>
</template>
