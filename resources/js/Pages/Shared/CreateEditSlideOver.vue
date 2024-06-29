<script lang="ts" setup>
import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseSlideover from '@/Components/Base/headless/Slideover/BaseSlideover.vue'
import BaseSlideoverDescription from '@/Components/Base/headless/Slideover/BaseSlideoverDescription.vue'
import BaseSlideoverFooter from '@/Components/Base/headless/Slideover/BaseSlideoverFooter.vue'
import BaseSlideoverPanel from '@/Components/Base/headless/Slideover/BaseSlideoverPanel.vue'
import BaseSlideoverTitle from '@/Components/Base/headless/Slideover/BaseSlideoverTitle.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{
    open: boolean
    title: string
    loading: boolean
    slideoverType: 'create' | 'update'
    focusableInput?: HTMLElement
}>()

const emit = defineEmits(['close', 'handleSubmit'])
</script>

<template>
    <base-slideover :initialFocus="focusableInput" :open @close="emit('close')">
        <base-slideover-panel class="">
            <a class="absolute top-0 start-0 end-auto mt-4 -ms-12" href="#" @click="emit('close')">
                <svg-loader class="w-8 h-8 fill-slate-400" name="icon-x-mark"></svg-loader>
            </a>

            <form @submit.prevent="emit('handleSubmit')">
                <base-slideover-title>
                    <h2 class="me-auto text-base font-medium">
                        {{ title }}
                    </h2>
                </base-slideover-title>

                <base-slideover-description class="grid grid-cols-12 gap-4 gap-y-3">
                    <slot name="description"></slot>
                </base-slideover-description>

                <base-slideover-footer class="flex justify-end">
                    <base-button class="w-20 me-1" type="button" variant="outline-secondary" @click="emit('close')">
                        {{ $t('cancel') }}
                    </base-button>

                    <base-button :disabled="loading" class="w-20" type="submit" variant="primary">
                        <spinner-button-loader :show="loading"></spinner-button-loader>

                        {{ $t(slideoverType) }}
                    </base-button>
                </base-slideover-footer>
            </form>
        </base-slideover-panel>
    </base-slideover>
</template>
