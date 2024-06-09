<script setup lang="ts">
import { defineAsyncComponent, defineProps } from 'vue'
import IcewallSideMenuLoader from '@/Layouts/loaders/IcewallSideMenuLoader.vue'
import IcewallSimpleMenuLoader from '@/Layouts/loaders/IcewallSimpleMenuLoader.vue'
import IcewallTopMenuLoader from '@/Layouts/loaders/IcewallTopMenuLoader.vue'
import { useSettingsStore } from '@/stores/settings'

defineProps<{ showLoader: boolean }>()

const sideMenu = defineAsyncComponent({
    loader: () => import('./side-menu/TheSideMenu.vue'),
    loadingComponent: IcewallSideMenuLoader
})

const simpleMenu = defineAsyncComponent({
    loader: () => import('./simple-menu/TheSimpleMenu.vue'),
    loadingComponent: IcewallSimpleMenuLoader
})

const topMenu = defineAsyncComponent({
    loader: () => import('./top-menu/TheTopMenu.vue'),
    loadingComponent: IcewallTopMenuLoader
})

const settingsStore = useSettingsStore()
</script>

<template>
    <Suspense v-if="settingsStore.layout === 'simple-menu'">
        <component :is="simpleMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <icewall-simple-menu-loader></icewall-simple-menu-loader>
        </template>
    </Suspense>

    <Suspense v-if="settingsStore.layout === 'side-menu'">
        <component :is="sideMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <icewall-side-menu-loader></icewall-side-menu-loader>
        </template>
    </Suspense>

    <Suspense v-if="settingsStore.layout === 'top-menu'">
        <component :is="topMenu">
            <slot></slot>
        </component>
        <template v-if="showLoader" #fallback>
            <icewall-top-menu-loader></icewall-top-menu-loader>
        </template>
    </Suspense>
</template>
