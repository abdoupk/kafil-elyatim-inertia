<script lang="ts" setup>
import { defineAsyncComponent } from 'vue'

import ShowModal from '@/Components/Global/ShowModal.vue'

const BaseFormLabel = defineAsyncComponent(() => import('@/Components/Base/form/BaseFormLabel.vue'))

defineProps<{
    open: boolean
    title: string
}>()

// Define custom event emitter for 'close' event
const emit = defineEmits(['close'])
</script>

<template>
    <show-modal :open :title @close="emit('close')">
        <template #description>
            <!-- Begin: Name-->
            <div class="col-span-12">
                <base-form-label htmlFor="name">
                    {{ $t('validation.attributes.name') }}
                </base-form-label>
            </div>
            <!-- End: Name-->

            <!-- Begin: Name-->
            <div class="col-span-12">
                <base-form-label htmlFor="description">
                    {{ $t('validation.attributes.description') }}
                </base-form-label>
            </div>
            <!-- End: Name-->
        </template>
    </show-modal>
</template>
