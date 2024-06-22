<script setup lang="ts">
import { useZonesStore } from '@/stores/zones'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormTextArea from '@/Components/Base/form/BaseFormTextArea.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseDialog from '@/Components/Base/headless/Dialog/BaseDialog.vue'
import BaseDialogDescription from '@/Components/Base/headless/Dialog/BaseDialogDescription.vue'
import BaseDialogFooter from '@/Components/Base/headless/Dialog/BaseDialogFooter.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import BaseDialogTitle from '@/Components/Base/headless/Dialog/BaseDialogTitle.vue'

import { n__ } from '@/utils/i18n'

defineProps<{ open: boolean }>()

const zonesStore = useZonesStore()

const nameInputRef = ref<HTMLButtonElement>()

const loading = ref(false)

const emit = defineEmits(['close', 'process'])

const handleSubmit = async () => {
    loading.value = true

    zonesStore.zone.id
        ? await zonesStore.updateZone().finally(handleSuccess)
        : await zonesStore.createZone().finally(handleSuccess)
}

const handleSuccess = () => {
    loading.value = false

    if (Object.keys(zonesStore.errors).length === 0) {
        setTimeout(() => {
            router.get(
                route('tenant.zones.index'),
                {},
                {
                    only: ['zones'],
                    preserveState: true
                }
            )
        }, 200)

        emit('close')
    }
}
</script>

<template>
    <base-dialog :open @close="emit('close')" :initialFocus="nameInputRef">
        <base-dialog-panel>
            <form @submit.prevent="handleSubmit">
                <base-dialog-title>
                    <h2 class="me-auto text-base font-medium">
                        {{ zonesStore.zone.id ? $t('update zone') : n__('add new', 0, { attribute: $t('zone') }) }}
                    </h2>
                </base-dialog-title>

                <base-dialog-description class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <base-form-label htmlFor="name">
                            {{ $t('zone name') }}
                        </base-form-label>

                        <base-form-input
                            v-model="zonesStore.zone.name"
                            id="name"
                            type="text"
                            placeholder="example@gmail.com"
                            ref="{nameInputRef}"
                        />

                        <div class="mt-2" v-if="zonesStore.errors?.name">
                            <base-input-error :message="zonesStore.errors.name[0]"></base-input-error>
                        </div>
                    </div>

                    <div class="col-span-12">
                        <base-form-label htmlFor="description">
                            {{ $t('validation.attributes.description') }}
                        </base-form-label>

                        <base-form-text-area
                            v-model="zonesStore.zone.description"
                            id="description"
                            type="text"
                            rows="5"
                            placeholder="example@gmail.com"
                        />

                        <div class="mt-2" v-if="zonesStore.errors?.description">
                            <base-input-error :message="zonesStore.errors.description[0]"></base-input-error>
                        </div>
                    </div>
                </base-dialog-description>

                <base-dialog-footer class="flex justify-end">
                    <base-button type="button" variant="outline-secondary" @click="emit('close')" class="w-20 me-1">
                        {{ $t('cancel') }}
                    </base-button>
                    <base-button variant="primary" type="submit" :disabled="loading" class="w-20">
                        <spinner-button-loader :show="loading"></spinner-button-loader>

                        {{ zonesStore.zone.id ? $t('update') : $t('create') }}
                    </base-button>
                </base-dialog-footer>
            </form>
        </base-dialog-panel>
    </base-dialog>
</template>
