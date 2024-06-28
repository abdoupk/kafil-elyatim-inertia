<script lang="ts" setup>
import { ref } from 'vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseSlideover from '@/Components/Base/headless/Slideover/BaseSlideover.vue'
import BaseSlideoverDescription from '@/Components/Base/headless/Slideover/BaseSlideoverDescription.vue'
import BaseSlideoverPanel from '@/Components/Base/headless/Slideover/BaseSlideoverPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import AppearanceSelector from '@/Components/theme-switcher/AppearanceSelector.vue'
import ColorSchemeSelector from '@/Components/theme-switcher/ColorSchemeSelector.vue'
import LayoutSelector from '@/Components/theme-switcher/LayoutSelector.vue'
import ThemeSelector from '@/Components/theme-switcher/ThemeSelector.vue'

const slideoverStatus = ref<boolean>(false)

const changeStatus = (value: boolean): void => {
    slideoverStatus.value = value
}
</script>

<template>
    <base-slideover class="dialog" :open="slideoverStatus" @close="changeStatus(false)">
        <base-slideover-panel>
            <base-button
                as="a"
                @click="changeStatus(false)"
                class="absolute inset-y-0 end-auto start-0 my-auto -ms-[60px] flex h-8 w-8 items-center justify-center rounded-full border border-white/90 bg-white/5 text-white/90 transition-all hover:rotate-180 hover:scale-105 hover:bg-white/10 focus:outline-none sm:-ms-[105px] sm:h-14 sm:w-14"
            >
                <svg-loader name="icon-x-mark" class="h-3 w-3 !fill-current stroke-[1] sm:h-8 sm:w-8"></svg-loader>
            </base-button>
            <base-slideover-description class="p-0">
                <div class="flex flex-col">
                    <theme-selector></theme-selector>
                    <div class="border-b border-dashed"></div>
                    <layout-selector></layout-selector>
                    <div class="border-b border-dashed"></div>
                    <color-scheme-selector></color-scheme-selector>
                    <div class="border-b border-dashed"></div>
                    <appearance-selector></appearance-selector>
                </div>
            </base-slideover-description>
        </base-slideover-panel>
    </base-slideover>

    <base-button
        as="div"
        @click="changeStatus(true)"
        class="dark:border-1 fixed bottom-0 end-0 z-50 mb-5 me-5 flex h-14 w-14 cursor-pointer items-center justify-center rounded-full border-0 bg-theme-1 text-white shadow-lg"
    >
        <svg-loader name="icon-gear-complex" class="h-5 w-5 animate-spin !fill-current duration-[3000]"></svg-loader>
    </base-button>
</template>
