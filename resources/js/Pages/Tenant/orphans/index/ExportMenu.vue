<script setup lang="ts">
import type { IndexParams } from '@/types/types'

import print from 'print-js'
import { ref } from 'vue'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseMenu from '@/Components/Base/headless/Menu/BaseMenu.vue'
import BaseMenuButton from '@/Components/Base/headless/Menu/BaseMenuButton.vue'
import BaseMenuItem from '@/Components/Base/headless/Menu/BaseMenuItem.vue'
import BaseMenuItems from '@/Components/Base/headless/Menu/BaseMenuItems.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<{
    params: IndexParams
}>()

const printStarting = ref<boolean>(false)

const printPdf = () => {
    print({
        printable: route('tenant.orphans.export.pdf', props.params),
        type: 'pdf',
        onLoadingStart: () => {
            printStarting.value = true
        },
        onLoadingEnd: () => {
            printStarting.value = false
        }
    })
}
</script>

<template>
    <base-menu>
        <base-menu-button :as="BaseButton" class="!box px-2">
            <span class="flex h-5 w-5 items-center justify-center">
                <svg-loader name="icon-file-export" class="h-5 w-5 fill-current" />
            </span>
        </base-menu-button>
        <base-menu-items class="w-48" placement="bottom-start">
            <base-menu-item
                :disabled="printStarting"
                as="button"
                @click.prevent="printPdf"
                :class="{ '!cursor-not-allowed opacity-80': printStarting }"
            >
                <svg-loader name="icon-print" class="me-2 h-4 w-4 fill-current" />
                {{ $t('print') }}
                <spinner-button-loader :show="printStarting"></spinner-button-loader>
            </base-menu-item>
            <base-menu-item as="a" :href="route('tenant.orphans.export.xlsx', params)">
                <svg-loader name="icon-file-excel" class="me-2 h-4 w-4 fill-current" />
                {{ $t('export', { type: 'excel' }) }}
            </base-menu-item>
            <base-menu-item as="a" :href="route('tenant.orphans.export.pdf', params)">
                <svg-loader name="icon-file-pdf" class="me-2 h-4 w-4 fill-current" />
                {{ $t('export', { type: 'pdf' }) }}
            </base-menu-item>
        </base-menu-items>
    </base-menu>
</template>
