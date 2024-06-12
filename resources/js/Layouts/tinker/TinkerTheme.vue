<script setup lang="ts">
import { defineAsyncComponent, defineProps } from 'vue'
import TinkerSideMenuLoader from '@/Layouts/loaders/TinkerSideMenuLoader.vue'
import TinkerSimpleMenuLoader from '@/Layouts/loaders/TinkerSimpleMenuLoader.vue'
import TinkerTopMenuLoader from '@/Layouts/loaders/TinkerTopMenuLoader.vue'
import { useSettingsStore } from '@/stores/settings'

defineProps<{ showLoader: boolean }>()

const sideMenu = defineAsyncComponent({
    loader: () => import('./side-menu/TheSideMenu.vue'),
    loadingComponent: TinkerSideMenuLoader
})

const simpleMenu = defineAsyncComponent({
    loader: () => import('./simple-menu/TheSimpleMenu.vue'),
    loadingComponent: TinkerSimpleMenuLoader
})

const topMenu = defineAsyncComponent({
    loader: () => import('./top-menu/TheTopMenu.vue'),
    loadingComponent: TinkerTopMenuLoader
})

const settingsStore = useSettingsStore()
</script>

<template>
    <Suspense v-if="settingsStore.layout === 'simple_menu'">
        <component :is="simpleMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <tinker-simple-menu-loader></tinker-simple-menu-loader>
        </template>
    </Suspense>

    <Suspense v-if="settingsStore.layout === 'side_menu'">
        <component :is="sideMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <tinker-side-menu-loader></tinker-side-menu-loader>
        </template>
    </Suspense>

    <Suspense v-if="settingsStore.layout === 'top_menu'">
        <component :is="topMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <tinker-top-menu-loader></tinker-top-menu-loader>
        </template>
    </Suspense>
</template>
