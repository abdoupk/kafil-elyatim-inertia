<script setup lang="ts">
import { defineAsyncComponent, defineProps } from 'vue'
import RubickSideMenuLoader from '@/Layouts/loaders/RubickSideMenuLoader.vue'
import RubickSimpleMenuLoader from '@/Layouts/loaders/RubickSimpleMenuLoader.vue'
import RubickTopMenuLoader from '@/Layouts/loaders/RubickTopMenuLoader.vue'
import { useSettingsStore } from '@/stores/settings'

defineProps<{ showLoader: boolean }>()

const sideMenu = defineAsyncComponent({
    loader: () => import('./side-menu/TheSideMenu.vue'),
    loadingComponent: RubickSideMenuLoader
})

const simpleMenu = defineAsyncComponent({
    loader: () => import('./simple-menu/TheSimpleMenu.vue'),
    loadingComponent: RubickSimpleMenuLoader
})

const topMenu = defineAsyncComponent({
    loader: () => import('./top-menu/TheTopMenu.vue'),
    loadingComponent: RubickTopMenuLoader
})

const settingsStore = useSettingsStore()
</script>

<template>
    <Suspense v-if="settingsStore.layout === 'simple_menu'">
        <component :is="simpleMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <rubick-simple-menu-loader></rubick-simple-menu-loader>
        </template>
    </Suspense>

    <Suspense v-if="settingsStore.layout === 'side_menu'">
        <component :is="sideMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <rubick-side-menu-loader></rubick-side-menu-loader>
        </template>
    </Suspense>

    <Suspense v-if="settingsStore.layout === 'top_menu'">
        <component :is="topMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <rubick-top-menu-loader></rubick-top-menu-loader>
        </template>
    </Suspense>
</template>
