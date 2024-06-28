<script setup lang="ts">
import { useSettingsStore } from '@/stores/settings'
import { defineAsyncComponent, defineProps } from 'vue'

import EnigmaSideMenuLoader from '@/Layouts/loaders/EnigmaSideMenuLoader.vue'
import EnigmaSimpleMenuLoader from '@/Layouts/loaders/EnigmaSimpleMenuLoader.vue'
import EnigmaTopMenuLoader from '@/Layouts/loaders/EnigmaTopMenuLoader.vue'

defineProps<{ showLoader: boolean }>()

const sideMenu = defineAsyncComponent({
    loader: () => import('./side-menu/TheSideMenu.vue'),
    loadingComponent: EnigmaSideMenuLoader
})

const simpleMenu = defineAsyncComponent({
    loader: () => import('./simple-menu/TheSimpleMenu.vue'),
    loadingComponent: EnigmaSimpleMenuLoader
})

const topMenu = defineAsyncComponent({
    loader: () => import('./top-menu/TheTopMenu.vue'),
    loadingComponent: EnigmaTopMenuLoader
})

const settingsStore = useSettingsStore()
</script>

<template>
    <Suspense v-if="settingsStore.layout === 'simple_menu'">
        <component :is="simpleMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <enigma-simple-menu-loader></enigma-simple-menu-loader>
        </template>
    </Suspense>

    <Suspense v-if="settingsStore.layout === 'side_menu'">
        <component :is="sideMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <enigma-side-menu-loader></enigma-side-menu-loader>
        </template>
    </Suspense>

    <Suspense v-if="settingsStore.layout === 'top_menu'">
        <component :is="topMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <enigma-top-menu-loader></enigma-top-menu-loader>
        </template>
    </Suspense>
</template>
